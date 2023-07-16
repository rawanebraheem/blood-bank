<?php

namespace App\Http\Controllers\Website;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rules;
use App\Models\Client;
use App\Models\City;
use App\Models\BloodType;
use App\Models\Governorate;


class WebRegisterController extends Controller
{


    public function create(request $request)
    {
        $blood_types = BloodType::all();
        $governorates = Governorate::all();
        $cities = City::all();
        return view('website.register', compact('blood_types', 'governorates', 'cities'));
    }

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
        ], [

            'd_o_b.required' => 'The date of birth field is required',
            'city_id.required' => 'The city field is required',
            'blood_type_id.required' => 'The blood type field is required',
        ]);

        $request->merge(['password' => bcrypt($request->password)]);
        $client = Client::create($request->all());


        return back()->with('success', 'Your account has been successfully registered');
    }
}
