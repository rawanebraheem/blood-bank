<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\Client;


class AuthController extends Controller
{
    private function response($status,$msg,$data){
        $response=[
            'status'=>$status,
            'msg'=>$msg, 
            'data'=>$data
            
          ];
          return  $response;
    }

   


    public function registration(request $request){
        $request->validate([
            'name' => ['required', 'string', 'max:70'],
            'email' => ['required', 'string', 'email', 'max:60', 'unique:'.Client::class],
            'password' => ['required',Rules\Password::defaults() ],//,'confirmed'
            'phone'=>['required','unique:'.Client::class],
            'blood_type_id'=>['required','numeric'],
            'last_donation_date'=>['required'],
            'city_id'=>['required','numeric'],
             'd_o_b'=>['required']
    
        ]);  

        
        $client = Client::create([
            'name' => $request->name, 
            'email' => $request->email,  
            'phone'=> $request->phone,
            'password' => Hash::make($request->password),
            'blood_type_id'=>$request->blood_type_id,
            'last_donation_date'=>$request->last_donation_date,
            'city_id'=>$request->city_id, 
            'd_o_b'=>$request->d_o_b,  
            
            
        ]);   
      
        $client->pin_code=null;
        $token=$client->createToken('token')->plainTextToken;
        $client->save();
        

        $client=$client->toArray();
        array_push($client,['token'=>$token]); 
        $response=self::response(1,"kolo tamam",$client);
        return $response; 

    }
//sent the token in the registration
////sent the token in the login



    public function login(request $request){
       
        $request->validate([
            'email' => 'required', 
            'password' => 'required',
        ]);
     
        $credentials = $request->only('email', 'password');
          
         if ( auth('api-web')->validate($credentials) ) {

         $client=Client::where('email',$request->email)->first(); 
    
          $token=$client->createToken('token')->plainTextToken;
           $client=$client->toArray();
         array_push($client,['token'=>$token]); 

          $response=self::response(1,"kolo tamam",$client);
           return $response; 
          }
   //look when i use the get() instead of first it doesnot work
        //  return ....... what shoud i return here;

         
          } 



          public function logout(request $request){
         //how it can knows if the logout success to return 1 or not
            Auth::logout();
            $response=self::response(1,"kolo tamam",[]);
            return $response; 
          }


          
       

      
}



