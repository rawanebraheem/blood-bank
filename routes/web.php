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


Route::get('test', function () {
    return view('test2');
});


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


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
