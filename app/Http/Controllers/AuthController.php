<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use ApiResponse;

    public function registration(request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:70'],
            'email' => ['required', 'string', 'email', 'max:60', 'unique:' . Client::class],
            'password' => ['required', Rules\Password::defaults()], //,'confirmed'
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

        $client->token = $token;

        return self::response(1, "success", $client);

    }
//sent the token in the registration
////sent the token in the login

    public function login(request $request)
    {

        $request->validate([
            'phone' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('phone', 'password')+['is_active'=> 1];
    //dd($credentials);

        if (auth('api-web')->validate($credentials)) {

            $client = Client::where('phone', $request->phone)->first();

            $token = $client->createToken('token')->plainTextToken;
            $client = $client->toArray();
            $client['token'] = $token;
           
            return self::response(1, "success", $client);
        } else {

            return self::response(0, "failed");
        }
        //look when i use the get() instead of first it doesnot work
        //  return ....... what shoud i return here;

    }

    public function logout($client=null)
    {
        //how it can knows if the logout success to return 1 or not
        if($client){
        $client->tokens()->delete();
         //$client->currentAccessToken()->delete();

        }else{
            auth('sanctum')->user()->tokens()->delete();
        // auth('sanctum')->user()->currentAccessToken()->delete();
        }

        return self::response(1, 'success');
        
        
    }

}
