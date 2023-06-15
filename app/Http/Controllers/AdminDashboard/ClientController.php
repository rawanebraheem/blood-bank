<?php

namespace App\Http\Controllers\AdminDashboard;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\City;
use App\Models\BloodType;
use App\Models\Governorate;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\AuthController;




use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(request $request)
    {


        $clients = Client::with('city', 'bloodType')->where(function ($query) use ($request) {
            if ($request->search) {
                $query->where('phone', 'LIKE', '%' . $request->search . '%')
                    ->orWhere('email', 'LIKE', '%' . $request->search . '%');
            }
        })->paginate(10);
        return view('clients.view_clients', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $blood_types = BloodType::all();
        $governorates = Governorate::all();
        $cities = City::all();
        return view('clients.add_clients', compact('blood_types', 'governorates', 'cities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:70'],
            'email' => ['required', 'string', 'email', 'max:60', 'unique:' . Client::class],
            'password' => ['required', Rules\Password::defaults(), 'confirmed'], //,'confirmed'
            'phone' => ['required', 'unique:' . Client::class],
            'blood_type_id' => ['required', 'numeric'],
            'last_donation_date' => ['required'],
            'city_id' => ['required', 'numeric'],
            'd_o_b' => ['required'],
        ]);
        $request->merge(['password' => bcrypt($request->password)]);
        $client = Client::create($request->all());

        $client->pin_code = null;
        $client->save();
        $token = $client->createToken('token')->plainTextToken;

        return back()->with('success', 'successfly added');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $client = Client::findorfail($id);
        $blood_types = BloodType::all();
        $governorates = Governorate::all();
        $cities = City::all();
        return view('clients.edit_client', compact('client', 'blood_types', 'governorates', 'cities'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:70'],
            'email' => ['required', 'string', 'email', 'max:60',  'unique:clients,email,' . $id],
            //'password' => ['nullable', Rules\Password::defaults()], //,'confirmed'
            'phone' => ['required', 'unique:clients,phone,' . $id],
            'blood_type_id' => ['required', 'numeric'],
            'last_donation_date' => ['required'],
            'city_id' => ['required', 'numeric'],
            'd_o_b' => ['required'],
            'is_active' => ['required', 'numeric'],

        ]);

        $request->merge(['password' => bcrypt($request->password)]);
        $client = Client::findorfail($id);

        $client->update($request->all());

        if ($client->is_active == 0) {
            //how can i call the logout method from the other class
            //how can i knew if the user in the app or in the web
            //how can i handle the web and flash session
            $logout=(new AuthController)->logout($client); 

            //this for web client
            //$client->logout();
            // redirect to where
            //return redirect('login');
        }
        

        

        return back()->with('success', 'successfly updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $client = Client::findorfail($id);
        $client->delete();
        return back()->with('success', 'successfly deleted');
    }


    public function searchClient(string $search)
    {
    }
}