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
use App\Http\Controllers\TransportController;
use App\Http\Controllers\LocationController;



Route::get('/transport-list', [TransportController::class, 'index'])->name('transport.list');
Route::get('/transportfront', [TransportController::class, 'index1'])->name('transport.front');
Route::get('/transport-add', [TransportController::class, 'create'])->name('transport.add');
Route::post('/transport-store', [TransportController::class, 'store'])->name('transport.store');
Route::delete('/transport/{id}', [TransportController::class, 'destroy'])->name('transport.delete');
Route::get('/transport-edit-{id}', [TransportController::class, 'edit'])->name('transport.edit');
Route::put('/transport/update/{id}', [TransportController::class, 'update'])->name('transport.update');
Route::get('/transport-details-{id}', [TransportController::class, 'show'])->name('transport.show');


// Location Transport routes
Route::get('/location-list', [LocationController::class, 'index'])->name('location.list');
Route::get('/location-add', [LocationController::class, 'create'])->name('location-transport.create');
Route::post('/location-transport', [LocationController::class, 'store'])->name('location-transport.store');
Route::delete('/location/{id}', [LocationController::class, 'destroy'])->name('location.delete');
Route::get('/location-edit-{id}', [LocationController::class, 'edit'])->name('location.edit');
Route::put('/location-transport/update/{id}', [LocationController::class, 'update'])->name('location-transport.update');






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
