<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\ResetPassword;
use App\Http\Controllers\ChangePassword;            
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\AvisRestaurantController;
use App\Http\Controllers\ReservationRestaurantController;


Route::get('/restaurant-list', [RestaurantController::class, 'index'])->name('restaurant.list');
Route::get('/restaurant-add', [RestaurantController::class, 'create'])->name('restaurant.add');
Route::post('/restaurant-store', [RestaurantController::class, 'store'])->name('restaurant.store');
Route::delete('/restaurant/{id}', [RestaurantController::class, 'destroy'])->name('restaurant.delete');
Route::get('/restaurant-edit-{id}', [RestaurantController::class, 'edit'])->name('restaurant.edit');
Route::put('/restaurant/update/{id}', [RestaurantController::class, 'update'])->name('restaurant.update');
Route::get('/restaurant-details-{id}', [RestaurantController::class, 'show'])->name('restaurant.show');

Route::get('/restaurant-list-client', [RestaurantController::class, 'indexClient'])->name('restaurant.list.client');
Route::get('/restaurant-client-details-{id}', [RestaurantController::class, 'showClient'])->name('restaurant.show.client');



Route::delete('/avis-restaurant-client/{id}', [AvisRestaurantController::class, 'destroyClient'])->name('avis.restaurant.client.delete');
Route::get('/avis-restaurant-list', [AvisRestaurantController::class, 'index'])->name('avis.restaurant.list');
Route::delete('/avis-restaurant/{id}', [AvisRestaurantController::class, 'destroy'])->name('avis.restaurant.delete');
Route::post('/restaurant-avis-store/{id}', [AvisRestaurantController::class, 'store'])->name('avis.restaurant.store');
Route::put('/avis-restaurant-update/{id}', [AvisRestaurantController::class, 'update'])->name('avis.restaurant.update');
Route::post('/restaurant-reserver', [ReservationRestaurantController::class, 'store'])->name('restaurant.reserver');



Route::get('/reservation-restaurant-list', [ReservationRestaurantController::class, 'index'])->name('reservation.restaurant.list');
Route::delete('/reservation-restaurant/{id}', [ReservationRestaurantController::class, 'destroy'])->name('reservation.restaurant.delete');


Route::get('/', function () {return redirect('/dashboard');})->middleware('auth');
	Route::get('/register', [RegisterController::class, 'create'])->middleware('guest')->name('register');
	Route::post('/register', [RegisterController::class, 'store'])->middleware('guest')->name('register.perform');
	Route::get('/login', [LoginController::class, 'show'])->middleware('guest')->name('login');
	Route::post('/login', [LoginController::class, 'login'])->middleware('guest')->name('login.perform');
	Route::get('/reset-password', [ResetPassword::class, 'show'])->middleware('guest')->name('reset-password');
	Route::post('/reset-password', [ResetPassword::class, 'send'])->middleware('guest')->name('reset.perform');
	Route::get('/change-password', [ChangePassword::class, 'show'])->middleware('guest')->name('change-password');
	Route::post('/change-password', [ChangePassword::class, 'update'])->middleware('guest')->name('change.perform');
	Route::get('/dashboard', [HomeController::class, 'index'])->name('home')->middleware('auth');
Route::group(['middleware' => 'auth'], function () {
	Route::get('/virtual-reality', [PageController::class, 'vr'])->name('virtual-reality');
	Route::get('/rtl', [PageController::class, 'rtl'])->name('rtl');
	Route::get('/profile', [UserProfileController::class, 'show'])->name('profile');
	Route::post('/profile', [UserProfileController::class, 'update'])->name('profile.update');
	Route::get('/profile-static', [PageController::class, 'profile'])->name('profile-static'); 
	Route::get('/sign-in-static', [PageController::class, 'signin'])->name('sign-in-static');
	Route::get('/sign-up-static', [PageController::class, 'signup'])->name('sign-up-static'); 
	Route::get('/{page}', [PageController::class, 'index'])->name('page');
	Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});