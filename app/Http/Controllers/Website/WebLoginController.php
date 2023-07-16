<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class WebLoginController extends Controller
{
    public function create()
    {
        return view('website.login');
    }


    public function store(Request $request)
    {
        $credentials = $request->validate([
            'phone' => ['required'],
            'password' => ['required'],
        ]);
        
        $remember_me = $request->has('remember_me') ? true : false; 
       
        
        if (Auth::guard('api-web')->attempt($credentials, $remember_me)) {
            $request->session()->regenerate();

            return redirect('web/home');
        }

        return back()->with('error', 'the authentication failed');
    }


    public function logout(Request $request)
    { //بنحدد الجارد ولا لا؟؟
        Auth::guard('api-web')->logout();

        $request->session()->invalidate();
        //اى التوكن دا زززدا غير بتاع ال ا بى اى؟؟
        $request->session()->regenerateToken();

        return redirect('web/home');
    }
}
