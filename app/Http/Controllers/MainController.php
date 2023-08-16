<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\BloodType;
use App\Models\Category;
use App\Models\City;
use App\Models\Client;
use App\Models\ClientGovernorate;
use App\Models\ClientNotification;
use App\Models\Contact;
use App\Models\Governorate;
use App\Models\Notification;
use App\Models\Request as DonationRequest;
use App\Models\Setting;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MainController extends Controller
{
    use ApiResponse;

    public function governorates()
    {
        $governorates = Governorate::all();
        return self::response(1, "success", $governorates);
    }

    public function cities(request $request)
    {

        if ($request->has('governorate_id')) {
            $cities = City::where('governorate_id', $request->governorate_id)->get();
        } else {
            $cities = City::all();
        }

        return self::response(1, "success", $cities);
    }

    public function bloodTypes()
    {

        $bloodtypes = BloodType::all();

        return self::response(1, "success", $bloodtypes);
    }

    public function categories()
    {

        $categories = Category::all();

        return self::response(1, "success", $categories);
    }

    public function articles(request $request)
    {

        $articles = Article::where(function ($query) use ($request) {
            if ($request->has('category_id')) {
                $query->where('category_id', $request->category_id);
            }
            if ($request->search) {
                $query->where('title', 'LIKE', '%' . $request->search . '%');
            }
        })->paginate(10); //get()




        return self::response(1, "success", [$articles]);
    }




    public function article(request $request)
    {
        $article = Article::find($request->article_id);

        return self::response(1, "success", $article);;
    }

    public function articleToggleFav(request $request)
    { 
        $request->validate([
            'article_id' => ['required', 'numeric'],
        ]);
      
        $toggle= Auth::user()->articles()->toggle($request->article_id);

        return self::response(1, "success", $toggle);;
    }

    public function settings()
    {
        $settings = Setting::first();

       // $settings = [$settings];

        return self::response(1, "success", $settings);
    }


    public function getClientData()
    {
        $client = Auth::user();

        return self::response(1, "success", $client);
    }

    public function setClientData(request $request)
    {

        $client = Auth::user();

        $request->validate([
            'name' => ['required', 'string', 'max:70'],
            'email' => ['required', 'string', 'email', 'max:60', 'unique:clients,email,' . Auth::user()->id],
            'password' => ['required', Rules\Password::defaults()], //,'confirmed'
            'phone' => ['required', 'unique:clients,phone,' . Auth::user()->id],
            'blood_type_id' => ['required', 'numeric'],
            'last_donation_date' => ['required'],
            'city_id' => ['required', 'numeric'],
            'd_o_b' => ['required'],

        ]);

        $client->name = $request->name;
        $client->email = $request->email;
        $client->password = Hash::make($request->password);
        $client->phone = $request->phone;
        $client->blood_type_id = $request->blood_type_id;
        $client->last_donation_date = $request->last_donation_date;
        $client->city_id = $request->city_id;
        $client->d_o_b = $request->d_o_b;

        $client->save();

        $response = self::response(1, "success", $client);
        return $response;
    }

    public function getRequests()
    {

        $requests = DonationRequest::paginate();

        return self::response(1, "success", $requests);
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

        

        $clients = Client::whereHas('governorates',function($query)  use($donation){
            $query->where('governorate_id',$donation->city->governorate_id);
        })->whereHas('bloodTypes',function($query) use($donation){
            $query->where('blood_type_id',$donation->blood_type_id);
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


         $notification->clients()->attach( $clients, ['is_read' => FALSE]);

         return self::response(1, "success", ['clients'=>$clients,'don_request'=>$don_request]);
    }

    public function getNotificationSettings()
    {

        //$client_governorates = Client::with('governorates')->where("id", Auth::user()->id)->get();
        //$client_bloodtype = Client::with('bloodtypes')->where("id", Auth::user()->id)->get();

        $client_bloodtypes_and_governorates= Client::with('bloodtypes','governorates')->find( Auth::user()->id);


        return self::response(1, "success",$client_bloodtypes_and_governorates );
    }

    public function setNotificationSettings(request $request)
    {
        $request->validate([
            'blood_types_array' => ['nullable','array'],
            'governorates_array' => ['nullable','array'],
            "blood_types_array.*" => ["nullable","numeric"],
            "governorates_array.*" => ["nullable","numeric"],

        ]);
       

        $client=Client::find(Auth::user()->id);
        

       
        $client->bloodTypes()->sync($request->blood_types_array);
        $client->governorates()->sync($request->governorates_array);
        $client_bloodtype_and_governorates = Client::with('bloodtypes','governorates')->find( Auth::user()->id);


        return self::response(1, "success", [ $client_bloodtype_and_governorates]);

         


    }


    public function getNotification(request $request)
    {
        
        $notification = Notification::where('id', $request->notification_id)->get();
        $notification_is_read = ClientNotification::where('client_id', Auth::user()->id)->where('notification_id', $request->notification_id)->first();
        //Another solution with updateExistingPivot()
        //$notification->clients()->updateExistingPivot(Auth::user()->id, ['is_read' => true]));
        $notification_is_read->is_read = true;
        $notification_is_read->save();


        return self::response(1, "success", $notification);
    }
    public function getNotifications()
    {
        $client=find(Auth::user()->id);
        $clint->notifications()->paginate();

       // $notifications = Client::with('notifications')->where('id', Auth::user()->id)->get();

        return self::response(1, "success", $clint);
    }

    public function accountRetrieveSendPinCode(request $request)
    {
        $request->validate([
            'phone' => 'required',
        ]);
        $phone = $request->phone;
        $client = Client::where('phone', $request->phone)->first();

        // $a=rand(111111,999999);

        if (!(is_null($client))) {

            for ($i = 0; $i < 6; $i++) {
                if ($i == 0) {
                    $pin_code = mt_rand(0, 9);
                } else {
                    $pin_code .= mt_rand(0, 9);
                }
            }
            $client->pin_code = $pin_code;
            $client->save();

            return self::response(1, "success", $pin_code);
        } else {

            return self::response(0, "failed");
        }
    }

    public function accountRetrieveCheckPinCode(request $request)
    {

        $client = Client::where('phone', $request->phone)->first();
        if (!(is_null($client))) {
            if ($request->pin_code == $client->pin_code) {
                $check_pin_code = true;

                return self::response(1, "success", $check_pin_code);
            } else {
                $check_pin_code = false;
            }

            return self::response(1, "success", $check_pin_code);
        }
    }

    public function passwordReset(request $request)
    {
        $request->validate([
            'comesfrom_forgetpassword' => ['required'],
            'newpassword' => ['required', Rules\Password::defaults()],
        ]);
        $client = Client::where('id', Auth::user()->id)->first();
        $identical = false;

        if (!($request->comesfrom_forgetpassword)) {
            $request->validate([
                'oldpassword' => 'required',
            ]);

            $credentials = ['email' => $client->email, 'password' => $request->oldpassword];

            $identical = auth('api-web')->validate($credentials);
        }

        if ($identical || $request->comesfrom_forgetpassword) {

            $client->password = Hash::make($request->newpassword);
            $client->save();
        }


        return self::response(1, "success", []);
    }

    public function contacts(request $request)
    {
        $request->validate([
            'phone' => ['required', 'numeric'],
            'title' => ['string', 'max:200'],
            'msg' => ['required'],

        ]);

        $contact = Contact::create([
            'client_id' => Auth::user()->id,
            'phone' => $request->phone,
            'title' => $request->title,
            'msg' => $request->msg,

        ]);

        

        return self::response(1, "success", $contact);
    }
}
