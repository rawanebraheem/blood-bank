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

// naming : kebab-case
Route::prefix('v1')->group(function () {
    Route::get('/governorates',  [MainController::class, 'governorates']);
    Route::post('/cities',  [MainController::class, 'cities']);
    Route::get('/bloodtypes',  [MainController::class, 'bloodTypes']);
    Route::post('/registration',  [AuthController::class, 'registration']);
    Route::post('/login',  [AuthController::class, 'login']);
    Route::get('/settings',  [MainController::class, 'settings']);   





    
Route::middleware('auth:sanctum')->group(function () { 
    Route::post('logout',  [AuthController::class, 'logout']);
    Route::get('/categories',  [MainController::class, 'categories']); 
    Route::post('/articles',  [MainController::class, 'articles']);
    Route::post('/articles-search',  [MainController::class, 'articlesSearch']);   
    Route::post('/article',  [MainController::class, 'article']);     
    Route::get('/get-client-data',  [MainController::class, 'getClientData']);      
    Route::post('/set-client-data',  [MainController::class, 'setClientData']);  
    Route::get('/get-requests',  [MainController::class, 'getRequests']);
    Route::post('/create-request',  [MainController::class, 'createRequest']);      
    Route::get('/get-notification-settings',  [MainController::class, 'getNotificationSettings']);
    Route::post('/set-notification-settings',  [MainController::class, 'setNotificationSettings']);
    Route::post('/create-notification-request',  [MainController::class, 'createNotificationRequest']);
    Route::post('/get-notification',  [MainController::class, 'getNotification']);
    Route::get('/get-notifications',  [MainController::class, 'getNotifications']); 
    Route::post('/account-retrieve-send-pincode',  [MainController::class, 'accountRetrieveSendPinCode']); 
    Route::post('/account-retrieve-check-pincode',  [MainController::class, 'accountRetrieveCheckPinCode']);   
    
    Route::post('/password-reset',  [MainController::class, 'passwordReset']); 
    Route::post('/contacts',  [MainController::class, 'contacts']);       
    
    
    }); 
 
 
 
   
});   

