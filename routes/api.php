<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;  



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function () {
    Route::get('/governorates',  [MainController::class, 'governorates']);
    Route::post('/cities',  [MainController::class, 'cities']);
    Route::get('/bloodtypes',  [MainController::class, 'bloodTypes']);
    Route::post('/register',  [AuthController::class, 'registration']);
    Route::post('/login',  [AuthController::class, 'login']);
    Route::get('/settings',  [MainController::class, 'settings']);   
 
 
 
   
});   

Route::prefix('v1')->group(function () { 
Route::post('/logout',  [AuthController::class, 'logout']);
Route::get('/categories',  [MainController::class, 'categories']); 
Route::post('/articles',  [MainController::class, 'articles']);
Route::post('/articlessearch',  [MainController::class, 'articlesSearch']);   
Route::post('/article',  [MainController::class, 'article']);     
Route::get('/getclientdata',  [MainController::class, 'getClientData']);      
Route::post('/setclientdata',  [MainController::class, 'setClientData']);  
Route::get('/getrequests',  [MainController::class, 'getRequests']);
Route::post('/createrequest',  [MainController::class, 'createRequest']);      
Route::get('/getnotificationsettings',  [MainController::class, 'getNotificationSettings']);
Route::post('/setnotificationsettings',  [MainController::class, 'setNotificationSettings']);
Route::post('/createnotificationrequest',  [MainController::class, 'createNotificationRequest']);
Route::post('/getnotification',  [MainController::class, 'getNotification']);
Route::get('/getnotifications',  [MainController::class, 'getNotifications']); 
Route::post('/accountretrievesendpincode',  [MainController::class, 'accountRetrieveSendPinCode']); 
Route::post('/accountretrievecheckpincode',  [MainController::class, 'accountRetrieveCheckPinCode']);   

Route::post('/passwordreset',  [MainController::class, 'passwordReset']); 
Route::post('/contacts',  [MainController::class, 'contacts']);       








}); 
