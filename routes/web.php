<?php

use App\Http\Controllers\ActiviteController;
use App\Http\Controllers\AvisActiviteController;
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
use App\Http\Controllers\ReservationActiviteController;






Route::get('/activites', [ActiviteController::class,'index'])->name('activites.list');
Route::get('/activites-create', [ActiviteController::class,'create'])->name('activites.create');
Route::post('/activites-store', [ActiviteController::class,'store'])->name('activites.store');
Route::delete('/activites/{id}', [ActiviteController::class,'destroy'])->name('activites.destroy');
Route::get('/activites-details-{id}', [ActiviteController::class,'show'])->name('activites.show');
Route::get('/activites-edit-{id}', [ActiviteController::class,'edit'])->name('activites.edit');
Route::put('/activites/update/{id}', [ActiviteController::class,'update'])->name('activites.update');
Route::get('/reservationactivites', [ReservationActiviteController::class,'index'])->name('reservations.list');
Route::get('/reservationactivites-create', [ReservationActiviteController::class,'create'])->name('reservations.create');
Route::post('/reservationactivites-store', [ReservationActiviteController::class,'store'])->name('reservations.store');
Route::delete('/reservationactivites/{id}', [ReservationActiviteController::class,'destroy'])->name('reservations.destroy');
Route::get('/reservationactivites-details-{id}', [ReservationActiviteController::class,'show'])->name('reservations.show');
Route::get('/reservationactivites-edit-{id}', [ReservationActiviteController::class,'edit'])->name('reservations.edit');
Route::put('/reservationactivites/update/{id}', [ReservationActiviteController::class,'update'])->name('reservations.update');
Route::get('/avisactivites', [AvisActiviteController::class,'index'])->name('avis.list');
Route::post('/avisactivites-store', [AvisActiviteController::class,'store'])->name('avis.store');
Route::delete('/avisactivites/{id}', [AvisActiviteController::class,'destroy'])->name('avis.destroy');
Route::get('/avisactivites-details-{id}', [AvisActiviteController::class, 'show'])->name('avis.show');
Route::get('/avisactivites-{id}-edit', [AvisActiviteController::class, 'edit'])->name('avis.edit');
Route::put('/avisactivites-{id}', [AvisActiviteController::class, 'update'])->name('avis.update');
Route::post('/reservationactivites-storee', [ReservationActiviteController::class, 'storee'])->name('reservations.storee');
Route::get('/activitesuser', [ActiviteController::class, 'indexx'])->name('activites.activities');



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
