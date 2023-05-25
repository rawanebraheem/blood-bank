<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth; 
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
  

  //$client_governorates=Client::with('governorates')->where("id",5)->get();
  $client = Client::find(1)->governorates();
  dd($client);
  //  $client_governorates=ClientGovernorate::select('governorate_id')->where("client_id",5)->get();/*Auth::user()->id*/
  //  $client_bloodtype=BloodTypeClient::select('blood_type_id')->where("client_id",5)->get();/*Auth::user()->id*/
 
  // $i=0;
  //   foreach($client_governorates as $governorate){
  //   $governorates[$i]=Governorate::where("id",$governorate->governorate_id)->first()->toArray();
  //    $i++;
  //  }
  //  $i=0;
  //   foreach($client_bloodtype as $bloodtype){
  //   $bloodtypes[$i]=BloodType::where("id",$bloodtype->blood_type_id)->first()->toArray();
  //    $i++;
  //  }
  //  $response=self::response(1,"kolo tamam",[$bloodtypes,$governorates]);
  //  return  $response;  
  
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
}