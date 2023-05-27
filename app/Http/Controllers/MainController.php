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
  $response=self::response(1,"kolo tamam",$governorates);
  return  $response;  
    }

 public function cities(request $request){
  
  if($request->has('governorate_id')){
    $cities=City::where('governorate_id',$request->governorate_id)->get();
  }else{
    $cities=City::all();

  }

  return $cities; 

 }   

 public function bloodTypes(){
 
  $bloodtypes=BloodType::all();
  $response=self::response(1,"kolo tamam",$bloodtypes);
  return  $response; 
    }



    public function categories(){ 

      $categories=Category::all(); 
     $response=self::response(1,"kolo tamam",$categories);
      return  $response; 
    }

    public function articles(request $request){ 

      $articles=Article::where(function($query) use($request){
           if($request->has('category_id'))
           {$query->where('category_id',$request->category_id);}


      })->get(); 

      $client_id=5;//Auth::user()->id;
      $fav_articles_ids=ArticleClient::select("article_id")->where('client_id', $client_id)->get();

      $response=self::response(1,"kolo tamam",[$articles,$fav_articles_ids]); 
      return $response;  
    }




    public function articlesSearch(request $request){

      $articles = Article::where(function($query) use($request){
        if($request->has('category_id'))
        {$query->where('category_id',$request->category_id);}

           })->where('title', 'LIKE',  '%'.$request->search.'%')->get(); 
       

      $response=self::response(1,"kolo tamam",$articles); 
          return $response;

     }


     public function article(request $request){
        $article= Article::where('id',$request->id)->first();
        $response=self::response(1,"kolo tamam",$article); 
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

     $response=self::response(1,"kolo tamam",$settings);  
     return $response;

   }

   public function getClientData(){
    $client=Client::find(5);//Auth::user()->id);
    $response=self::response(1,"kolo tamam",$client);  
    return $response;
   }


   public function setClientData(request $request){
    $client=Client::find(1);//Auth::user();
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


$client=Client::find(1);//Auth::user();
$client->email=null;
$client->phone=null;

$client->name=$request->name;
$client->email=$request->email;
$client->password=$request->password;
$client->phone=$request->phone;
$client->blood_type_id=$request->blood_type_id;
$client->last_donation_date=$request->last_donation_date;
$client->city_id=$request->city_id;
$client->d_o_b=$request->d_o_b;

$client->save();


$response=self::response(1,"kolo tamam",$client);  
   return $response;


  }


  public function getRequests(){
 
    $requests=requests::all();
    $response=self::response(1,"kolo tamam",$requests);
    return  $response;  
   }

   public function createRequest(request $request){
 
    $request->validate([
      'patient_name' => ['required', 'string', 'max:70'],
      'patient_phone'=>['required'],
      'hospital_name'=>['required'],
      'hospital_address'=>['required'],
      'bags_num' => ['numeric'],//,'confirmed'
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
$don_request->client_id = 5 ;//Auth::user()->id;

$don_request->save();


$response=self::response(1,"kolo tamam",$don_request);
return  $response;  
   }


   public function getNotificationSettings(){
  

  $client_governorates=Client::with('governorates')->where("id",5/*Auth::user()->id*/)->get();
  $client_bloodtype=Client::with('bloodtypes')->where("id",5/*Auth::user()->id*/)->get();
  
  
  
   $response=self::response(1,"kolo tamam",[$client_governorates,$client_bloodtype]);
   return  $response;  
  
  
   } 


   public function setNotificationSettings(request $request){
    
    if($request->has('blood_types_array') && $request->blood_types_array !=null ){
    $request->validate([ 
      'blood_types_array'=>['required','array'],
      "blood_types_array.*"  => ["numeric"],
    ]); 
  }


  if( $request->has('governorates_array') && $request->governorates_array !=null ){
    $request->validate([ 
      'governorates_array'=>['required','array'],
      "governorates_array.*"  => ["numeric"],
    ]); 
  }



    BloodTypeClient::where("client_id",5/*Auth::user()->id*/)->delete();
    ClientGovernorate::where("client_id",5/*Auth::user()->id*/)->delete();

    if($request->has('blood_types_array') && $request->blood_types_array!=null){
    foreach ($request->blood_types_array as $blood_type){
      BloodTypeClient::create([
        "client_id"=>5 /*Auth::user()->id*/,
        "blood_type_id"=>$blood_type,
      
       ]);  
     
    }}
 
    if( $request->has('governorates_array') && $request->governorates_array !=null ){
    foreach ($request->governorates_array as $governorate){
      ClientGovernorate::create([
        "client_id"=>5 /*Auth::user()->id*/,
        "governorate_id"=>$governorate,
      
       ]);   }}
     
   
   
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

 $clients=ClientGovernorate::select('client_id')->where('governorate_id', $governorate->id)->get();

foreach($clients as $client){
$client_notification= ClientNotification::create([
  'client_id'=>$client->client_id,
  'notification_id'=>$notification->id, 
  'is_read'=>FALSE
 
 ]);
 
} 

$response=self::response(1,"kolo tamam",[$notification,$clients]);
return  $response;

} 

public function getNotification(request $request){
$notification=Notification::where('id',$request->notification_id)->get();
$notification_is_read=ClientNotification::where('client_id',5/*Auth::user()->id*/)->
where('notification_id',$request->notification_id)->first();


$notification_is_read->is_read=TRUE;
$notification_is_read->save();

$response=self::response(1,"kolo tamam",$notification);
return  $response;

}
public function getNotifications(){

$notifications=Client::with('notifications')->where('id',5/*Auth::user()->id*/)->get();

$response=self::response(1,"kolo tamam",$notifications);
return  $response;
}

public function accountRetrieveSendPinCode(request $request){
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
 $response=self::response(1,"kolo tamam",$pin_code);
return  $response;
 
}}

public function accountRetrieveCheckPinCode (request $request){
 
  $client=Client::where('phone',$request->phone)->first();
  $check_pin_code=FALSE;
 if (!(is_null($client))){
if($request->pin_code == $client->pin_code){
  $check_pin_code=TRUE;
}
 
}
$response=self::response(1,"kolo tamam",$check_pin_code);
return  $response;



}

public function passwordReset(request $request){
  $request->validate([
    'comesfrom_forgetpassword' =>['required' ],
    'newpassword' => ['required', Rules\Password::defaults()]
]);
$client=Client::where('id',5/*Auth::user()->id*/)->first();
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

$response=self::response(1,"kolo tamam",[]);
return  $response;


}

public function contacts(request $request){
  $request->validate([
    'phone' => ['required','numeric'],
    'title' => ['string','max:200'],
    'msg' => ['required'],
    
]);

$contact=  Contact::create([
  'client_id' =>  5/*Auth::user()->id*/, 
  'phone' => $request->phone, 
  'title' => $request->title,  
  'msg'=> $request->msg,
 
]);  

//$contact->client_id = 5/*Auth::user()->id*/;
//$contact->save();
//if u run this code make the client_id gaurded
$response=self::response(1,"kolo tamam",$contact);
return  $response;


}



}