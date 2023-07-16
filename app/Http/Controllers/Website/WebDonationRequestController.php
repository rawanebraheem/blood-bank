<?php

namespace App\Http\Controllers\Website;

use App\Models\Request as DonationRequest;
use App\Models\BloodType;
use App\Models\Governorate;
use App\Models\City;



use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WebDonationRequestController extends Controller
{
    public function index(request $request)
    {
        $cities = City::all();
        $governorates = Governorate::all();
        $blood_types = BloodType::all();
       
        $donation_requests = DonationRequest::where(function ($query) use ($request) {
            if ($request->blood_type ||$request->city) {
                $query->where('blood_type_id',  $request->blood_type )
                    ->orWhere ('city_id',  $request->city );
                        
                  
            }
        })->paginate();
        return view('website.donation-requests', compact('donation_requests','blood_types', 'governorates', 'cities'));
    }



    public function show(string $id)
    {
        $donation_request = DonationRequest::with('client', 'city.governorate', 'bloodType')
            ->findorfail($id);
        return view('website.donation-request', compact('donation_request'));
    }


    public function create(request $request)
    {
        $blood_types = BloodType::all();
        $governorates = Governorate::all();
        $cities = City::all();
        return view('website.donation_request_create', compact('blood_types', 'governorates', 'cities'));
    }









    public function createRequest(request $request)
    {

        $request->validate([
            'patient_name' => ['required', 'string', 'max:70'],
            'patient_phone' => ['required'],
            'hospital_name' => ['required'],
            'hospital_address' => ['required'],
            'bags_num' => ['numeric'],
            'blood_type_id' => ['required', 'numeric'],
            'city_id' => ['required', 'numeric'],
            'patient_age' => ['numeric'],
            'latitude' => [],
            'longitude' => [],
            'details' => ['string'],

        ]);

        //$don_request = Auth::user()->requests()->create($request->all());
        $don_request = new DonationRequest($request->toArray());
        $don_request->client_id = Auth::user()->id;

        $don_request->save();

        //creating notification for the request
        $governorate = Governorate::where('id', $don_request->city->governorate_id)->first();

        $content = 'the donation request governorate:  ' . $governorate->name . "<br>" .
            'the donation request city:  ' . $don_request->city->name . "<br>" .
            'the blood type:  ' . $don_request->bloodType->name;

        $notification = Notification::create([
            'title' => 'There is a new donation request',
            'content' => $content,
            'request_id' => $request->request_id,

        ]);



        $clients = Client::whereHas('governorates', function ($query)  use ($donation) {
            $query->where('governorate_id', $donation->city->governorate_id);
        })->whereHas('bloodTypes', function ($query) use ($donation) {
            $query->where('blood_type_id', $donation->blood_type_id);
        })->pluck('id')->toArray();

        //Another solution

        // $governorate_clients = $governorate->clients()->get();
        // $bloodtype_clients =$don_request->bloodType->setting_clients()->get();

        // $i = 0;
        // foreach ($governorate_clients as $governorate_client) {
        //    $governorate_clients_array[$i] = $governorate_client->id;
        //     $i++;
        // }
        // $i = 0;
        // foreach ($bloodtype_clients as $bloodtype_client) {

        //     if (in_array($bloodtype_client->id, $governorate_clients_array)) {
        //         $clients[$i] = $bloodtype_client->id;
        //         $i++;
        //     }
        // }


        $notification->clients()->attach($clients, ['is_read' => FALSE]);

        return self::response(1, "success", ['clients' => $clients, 'don_request' => $don_request]);
    }
}
