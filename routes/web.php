<?php

use App\Http\Controllers\AvisTourController;
use App\Http\Controllers\GuideLocalController;
use App\Http\Controllers\ReservationTourController;
use App\Http\Controllers\TypeTourController;
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

Route::get('/guide-list', [GuideLocalController::class, 'index'])->name('guidelocal.list');
Route::get('/guide-add', [GuideLocalController::class, 'create'])->name('guidelocal.add');
Route::post('/guide-store', [GuideLocalController::class, 'store'])->name('guidelocal.store');
Route::delete('/guide/{id}', [GuideLocalController::class, 'destroy'])->name('guidelocal.delete');
Route::get('/guide-edit-{id}', [GuideLocalController::class, 'edit'])->name('guidelocal.edit');
Route::put('/guide/update/{id}', [GuideLocalController::class, 'update'])->name('guidelocal.update');
Route::get('/guide-details-{id}', [GuideLocalController::class, 'show'])->name('guidelocal.show');

Route::get('/type-tour-list', [TypeTourController::class, 'index'])->name('typetour.list');
Route::get('/type-tour-add', [TypeTourController::class, 'create'])->name('typetour.add');
Route::post('/type-tour-store', [TypeTourController::class, 'store'])->name('typetour.store');
Route::delete('/type-tour/{id}', [TypeTourController::class, 'destroy'])->name('typetour.delete');
Route::get('/type-tour-edit-{id}', [TypeTourController::class, 'edit'])->name('typetour.edit');
Route::put('/type-tour/update/{id}', [TypeTourController::class, 'update'])->name('typetour.update');
Route::get('/type-tour-details-{id}', [TypeTourController::class, 'show'])->name('typetour.show');

Route::get('/reservation-list', [ReservationTourController::class, 'index'])->name('reservationtour.list');
Route::get('/reservation-add', [ReservationTourController::class, 'create'])->name('reservationtour.add');
Route::post('/reservation-store', [ReservationTourController::class, 'store'])->name('reservationtour.store');
Route::delete('/reservation/{id}', [ReservationTourController::class, 'destroy'])->name('reservationtour.delete');
Route::get('/reservation-edit-{id}', [ReservationTourController::class, 'edit'])->name('reservationtour.edit');
Route::put('/reservation/update/{id}', [ReservationTourController::class, 'update'])->name('reservationtour.update');
Route::get('/reservation-details-{id}', [ReservationTourController::class, 'show'])->name('reservationtour.show');

Route::get('/avis-list', [AvisTourController::class, 'index'])->name('avistour.list');
Route::get('/avis-add', [AvisTourController::class, 'create'])->name('avistour.add');
Route::post('/avis-store', [AvisTourController::class, 'store'])->name('avistour.store');
Route::delete('/avis/{id}', [AvisTourController::class, 'destroy'])->name('avistour.delete');
Route::get('/avis-edit-{id}', [AvisTourController::class, 'edit'])->name('avistour.edit');
Route::put('/avis/update/{id}', [AvisTourController::class, 'update'])->name('avistour.update');
Route::get('/avis-details-{id}', [AvisTourController::class, 'show'])->name('avistour.show');

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
