<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminDashboard\ArticleController;
use App\Http\Controllers\AdminDashboard\CategoryController;
use App\Http\Controllers\AdminDashboard\CityController;
use App\Http\Controllers\AdminDashboard\ClientController;
use App\Http\Controllers\AdminDashboard\ContactController;
use App\Http\Controllers\AdminDashboard\DonationRequestController;
use App\Http\Controllers\AdminDashboard\GovernorateController;
use App\Http\Controllers\AdminDashboard\SettingController;
use App\Http\Controllers\AdminDashboard\RoleController;
use App\Http\Controllers\AdminDashboard\UserController;
//use App\Http\Controllers\Website\UserController;
use App\Http\Controllers\Website\WebMainController;
use App\Http\Controllers\Website\WebArticleController;
use App\Http\Controllers\Website\WebDonationRequestController;

use App\Http\Controllers\Website\WebRegisterController;
use App\Http\Controllers\Website\WebLoginController;
// use App\Http\Livewire\Governorate;











/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/




//web routes


Route::prefix('web')->group(function () {
    
    Route::get('home', [WebMainController::class, 'index']);
    Route::get('articles', [WebArticleController::class, 'index']);
    Route::get('article-details/{id}', [WebArticleController::class, 'show'])->name('article.show');
    Route::get('article-fav/{id}', [WebArticleController::class, 'articleToggleFav'])->name('article.fav');

    Route::get('donation-requests', [WebDonationRequestController::class, 'index']);
    Route::get('donation-request/{id}', [WebDonationRequestController::class, 'show']);
    Route::get('create-donation-request', [WebDonationRequestController::class, 'create']);
    Route::post('store-donation-request', [WebDonationRequestController::class, 'store']);

    Route::get('about-us', function () {
        return view('website.who-are-us');
    });
    Route::get('contact-us', function () {
        return view('website.contact-us');
    });
    Route::post('create-contact', [WebMainController::class, 'createContact']);
    Route::get('register', [WebRegisterController::class, 'create']);
    Route::get('login', [WebLoginController::class, 'create']);
    Route::post('register-store', [WebRegisterController::class, 'store']);
    Route::post('login-store', [WebLoginController::class, 'store']);
    Route::post('logout', [WebLoginController::class, 'logout']);




});
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//admin routes

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('cities', CityController::class);


    Route::resource('articles', ArticleController::class);
    Route::resource('cities', CityController::class);
    Route::resource('clients', ClientController::class);
    Route::resource('governorates', GovernorateController::class);
    Route::resource('categories', CategoryController::class);


    Route::get('contacts-index', [ContactController::class, 'index']);
    Route::post('contacts-destroy/{id}', [ContactController::class, 'destroy']);

    Route::get('donation-requests-index', [DonationRequestController::class, 'index']);
    Route::get('donation-requests-show/{id}', [DonationRequestController::class, 'show']);
    Route::post('donation-requests-destroy/{id}', [DonationRequestController::class, 'destroy']);

    Route::get('settings-edit', [SettingController::class, 'edit']);
    Route::post('settings-update', [SettingController::class, 'update']);

   
   
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
});

require __DIR__ . '/auth.php';
