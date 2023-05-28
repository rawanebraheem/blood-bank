<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Http\Request;
use App\Models\Governorate;
use App\Models\City;
use App\Models\BloodType; 
use App\Models\Category;
use App\Models\Article;
use App\Models\ArticleClient;
use App\Models\Setting;
use App\Models\Client;
use App\Models\Request as requests;
use App\Models\ClientGovernorate;
use App\Models\BloodTypeClient;
use App\Models\Notification;
use App\Models\ClientNotification;
use App\Models\Contact;
















class MainController extends Controller
{
    //
    private function response($status,$msg,$data){
        $response=[
            'status'=>$status,
            'msg'=>$msg,
            'data'=>$data
            
          ];
          return  $response;
    }

 public function governorates(){
  $governorates=Governorate::all();
  $response=self::response(1,"success",$governorates);
  return  $response;  
    }

 public function cities(request $request){
  
  if($request->has('governorate_id')){
    $cities=City::where('governorate_id',$request->governorate_id)->get();
  }else{
    $cities=City::all();

  }
  $response=self::response(1,"success",$cities);
  return  $response; 
  

 }   

 public function bloodTypes(){
 
  $bloodtypes=BloodType::all();
  $response=self::response(1,"success",$bloodtypes);
  return  $response; 
    }



    public function categories(){ 

      $categories=Category::all(); 
     $response=self::response(1,"success",$categories);
      return  $response; 
    }

    public function articles(request $request){ 

      $articles=Article::where(function($query) use($request){
           if($request->has('category_id'))
           {$query->where('category_id',$request->category_id);}


      })->get(); 

    
      $client_id=5;//Auth::user()->id;
      $fav_articles_ids=ArticleClient::select("article_id")->where('client_id', $client_id)->get();
    
      $response=self::response(1,"success",[$articles,$fav_articles_ids]); 
      return $response;  
    }




    public function articlesSearch(request $request){

      $articles = Article::where(function($query) use($request){
        if($request->has('category_id'))
        {$query->where('category_id',$request->category_id);}

           })->where('title', 'LIKE',  '%'.$request->search.'%')->get(); 
       

      $response=self::response(1,"success",$articles); 
          return $response;

     }


     public function article(request $request){
        $article= Article::where('id',$request->id)->first();
        $response=self::response(1,"success",$article); 
        return $response;
     }



     public function settings(){
     // how should i deal with it 
     $notification_settings_text= Setting::select('notification_settings_text')->get();
     $about_app= Setting::select('about_app')->get();
     $phone= Setting::select('phone')->get();
     $email= Setting::select('email')->get();
     $fb_link= Setting::select('fb_link')->get();
     $tw_link= Setting::select('tw_link')->get();
     $insta_link= Setting::select('insta_link')->get();
     $youtube_link= Setting::select('youtube_link')->get();

     $settings=[$notification_settings_text,$about_app,$phone,$email,$fb_link
     ,$tw_link,$insta_link,$youtube_link];

     $response=self::response(1,"success",$settings);  
     return $response;

   }

   public function getClientData(){
    $client=Auth::user()->id;
    $response=self::response(1,"success",$client);  
    return $response;
   }


   public function setClientData(request $request){
    //what will happend if two usrs do setClientData at the same time
    $client=Auth::user();
    $client->email=0000;
    $client->phone=0000;
    $client->save(); 
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


$client->name=$request->name;
$client->email=$request->email;
$client->password=$request->password;
$client->phone=$request->phone;
$client->blood_type_id=$request->blood_type_id;
$client->last_donation_date=$request->last_donation_date;
$client->city_id=$request->city_id;
$client->d_o_b=$request->d_o_b;

$client->save();


$response=self::response(1,"success",$client);  
   return $response;


  }


  public function getRequests(){
 
    $requests=requests::all();
    $response=self::response(1,"success",$requests);
    return  $response;  
   }

   public function createRequest(request $request){
 
    $request->validate([
      'patient_name' => ['required', 'string', 'max:70'],
      'patient_phone'=>['required'],
      'hospital_name'=>['required'],
      'hospital_address'=>['required'],
      'bags_num' => ['numeric'],
      'blood_type_id'=>['required','numeric'],
      'city_id'=>['required','numeric'],
      'patient_age'=>['numeric'],
      'latitude'=>[],
      'longitude'=>[],
      'details' => ['string'],


  ]);  

//   $don_request = requests::create([
//     'patient_name' => $request->patient_name, 
//     'patient_phone' => $request->patient_phone,  
//     'hospital_name'=> $request->hospital_name,
//     'hospital_address' => $request->hospital_address,
//     'bags_num'=>$request->bags_num,
//     'blood_type_id'=>$request->blood_type_id,
//     'city_id'=>$request->city_id, 
//     'patient_age'=>$request->patient_age,
//     'latitude'=>$request->latitude,  
//     'longitude'=>$request->longitude,  
//     'details'=>$request->details,  
// ]);  
$don_request = new requests($request->toArray());
$don_request->client_id = Auth::user()->id;

$don_request->save();


$response=self::response(1,"success",$don_request);
return  $response;  
   }


   public function getNotificationSettings(){
  

  $client_governorates=Client::with('governorates')->where("id",Auth::user()->id)->get();
  $client_bloodtype=Client::with('bloodtypes')->where("id",Auth::user()->id)->get();
  
  
  
   $response=self::response(1,"success",[$client_governorates,$client_bloodtype]);
   return  $response;  
  
  
   } 


   public function setNotificationSettings(request $request){
    $request->validate([   
      'blood_types_array'=>['required'],
      'governorates_array'=>['required']

     ]); 
    if( $request->blood_types_array !=null ){
    $request->validate([ 
      'blood_types_array'=>['array'],
      "blood_types_array.*"  => ["numeric"],
    ]); 
  }


  if( $request->governorates_array !=null ){
    $request->validate([ 
      'governorates_array'=>['array'],
      "governorates_array.*"  => ["numeric"],
    ]); 
  }
  BloodTypeClient::where("client_id",Auth::user()->id)->delete();
  ClientGovernorate::where("client_id",Auth::user()->id)->delete();



    if( $request->blood_types_array!=null){
       $i=0;
    foreach ($request->blood_types_array as $blood_type){
      $blood_types_client [$i] =BloodTypeClient::create([
        "client_id"=>Auth::user()->id,
        "blood_type_id"=>$blood_type,
      
       ]);  
       $i++;
    }}
 
    if( $request->governorates_array !=null ){
      $i=0;

    foreach ($request->governorates_array as $governorate){
      $client_governorates[$i] =ClientGovernorate::create([
        "client_id"=>Auth::user()->id,
        "governorate_id"=>$governorate,
      
       ]);   
       $i++;
      }}

     
$response=self::response(1,"success",[$blood_types_client,$client_governorates]);
return  $response;
   
}


public function createNotificationRequest(request $request){
$don_request=requests::with('city','bloodType')->where("id",$request->request_id)->first();
$governorate=Governorate::where('id',$don_request->city->governorate_id )->first();


  $content='the donation request governorate:  '.$governorate->name."<br>".
       'the donation request city:  ' .$don_request->city->name."<br>".
         'the blood type:  '.$don_request->bloodType->name;

$notification=  Notification::create([
  'title'=>'There is a new donation request',
  'content'=>$content,
  'request_id'=>$request->request_id
 
 ]); 

 $governorate_clients=ClientGovernorate::select('client_id')->where('governorate_id', $governorate->id)->get();
 $bloodtype_clients =BloodTypeClient::select('client_id')->where('blood_type_id', $don_request->bloodType->id)->get();
 $i=0;
foreach($governorate_clients as $governorate_client){
  $governorate_clients_array[$i]=$governorate_client->client_id;
  $i++;
}
$i=0;
foreach($bloodtype_clients as $bloodtype_client){
 
 if(in_array ($bloodtype_client->client_id ,$governorate_clients_array))
 {$clients[$i]=$bloodtype_client->client_id ;
  $i++;
}
}


foreach($governorate_clients as $client){
$client_notification= ClientNotification::create([
  'client_id'=>$client->client_id,
  'notification_id'=>$notification->id, 
  'is_read'=>FALSE
 
 ]);
 
} 
foreach($governorate_clients as $client){echo $client->client_id;}

 $response=self::response(1,"success",[$notification,$clients]);
  return  $response;

} 

public function getNotification(request $request){
$notification=Notification::where('id',$request->notification_id)->get();
$notification_is_read=ClientNotification::where('client_id',Auth::user()->id)->
where('notification_id',$request->notification_id)->first();


$notification_is_read->is_read=TRUE;
$notification_is_read->save();

$response=self::response(1,"success",$notification);
return  $response;

}
public function getNotifications(){

$notifications=Client::with('notifications')->where('id',Auth::user()->id)->get();

$response=self::response(1,"success",$notifications);
return $response;
}

public function accountRetrieveSendPinCode(request $request){
  $request->validate([
    'phone' => 'required', 
]);
  $phone=$request->phone;
  $client=Client::where('phone',$request->phone)->first();
 
  // $a=rand(111111,999999);

 if (!(is_null($client))){

 for ($i = 0; $i<6; $i++) 
        {
            if($i==0){
            $pin_code = mt_rand(0,9);
            }else{  $pin_code .= mt_rand(0,9);}
        }
 $client->pin_code=$pin_code;
 $client->save();
 $response=self::response(1,"success",$pin_code);
return  $response;
 
}else{ 
$response=self::response(0,"failed");
return  $response;
}

}

public function accountRetrieveCheckPinCode (request $request){
 
  $client=Client::where('phone',$request->phone)->first();
 if (!(is_null($client))){
if($request->pin_code == $client->pin_code){
  $check_pin_code=TRUE;
  $response=self::response(1,"success",$check_pin_code);
    return  $response;
}else{
  $check_pin_code=FALSE;
  
}
$response=self::response(1,"success",$check_pin_code);
return  $response;

 
}

}

public function passwordReset(request $request){
  $request->validate([
    'comesfrom_forgetpassword' =>['required' ],
    'newpassword' => ['required', Rules\Password::defaults()]
]);
$client=Client::where('id',Auth::user()->id)->first();
$identical=FALSE;

if(!($request->comesfrom_forgetpassword)){
  $request->validate([
    'oldpassword' => 'required',
]);

$credentials = ['email'=>$client->email,'password'=>$request->oldpassword];

 $identical=auth('api-web')->validate($credentials);

}

if ($identical || $request->comesfrom_forgetpassword){

  $client->password = Hash::make($request->newpassword);
  $client->save();
  
  } 

$response=self::response(1,"success",[]);
return  $response;


}

public function contacts(request $request){
  $request->validate([
    'phone' => ['required','numeric'],
    'title' => ['string','max:200'],
    'msg' => ['required'],
    
]);

$contact=  Contact::create([
  'client_id' =>  Auth::user()->id, 
  'phone' => $request->phone, 
  'title' => $request->title,  
  'msg'=> $request->msg,
 
]);  

//$contact->client_id = 5/*Auth::user()->id*/;
//$contact->save();
//if u run this code make the client_id gaurded
$response=self::response(1,"success",$contact);
return  $response;


}



}