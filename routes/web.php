<?php

use App\Http\Controllers\GuidesLocauxController;
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
<<<<<<< HEAD
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
Route::get('/transport-detail-{id}', [TransportController::class, 'show'])->name('transport.show');
Route::get('/transport-search', [TransportController::class, 'search'])->name('transport.search');





// Location Transport routes
Route::get('/location-list', [LocationController::class, 'index'])->name('location.list');
Route::get('/location-add', [LocationController::class, 'create'])->name('location-transport.create');
Route::post('/location-transport', [LocationController::class, 'store'])->name('location-transport.store');
Route::delete('/location/{id}', [LocationController::class, 'destroy'])->name('location.delete');
Route::get('/location-edit-{id}', [LocationController::class, 'edit'])->name('location.edit');
Route::put('/location-transport/update/{id}', [LocationController::class, 'update'])->name('location-transport.update');




use App\Http\Controllers\HebergementController;
use App\Http\Controllers\ReservationsHebergementController;

=======

use App\Http\Controllers\ChangePassword;            
use App\Http\Controllers\HebergementController;   
use App\Http\Controllers\ReservationsHebergementController;  
      
>>>>>>> 73d994c4ffe6b352ffeb00f5b6cc457bb0e2482d
Route::get('/hebergements', [HebergementController::class,'index'])->name('hebergement.index');
Route::get('/hebergement-create', [HebergementController::class,'create'])->name('hebergement.create');
Route::post('/hebergement-store', [HebergementController::class,'store'])->name('hebergement.store');
Route::delete('/hebergement/{id}', [HebergementController::class,'destroy'])->name('hebergement.destroy');
Route::get('/hebergement-details-{id}', [HebergementController::class,'show'])->name('hebergement.show');
Route::get('/hebergement-edit-{id}', [HebergementController::class,'edit'])->name('hebergement.edit');
Route::put('/hebergement/update/{id}', [HebergementController::class,'update'])->name('hebergement.update');
Route::get('/hebergements-search', [HebergementController::class, 'search'])->name('hebergement.search');
<<<<<<< HEAD
Route::get('/UIDetailsHebergement-{id}', [HebergementController::class, 'detailsHebergement'])->name('hebergement.details');
Route::get('/UIhebergements', [HebergementController::class, 'UI_index'])->name('hebergement.UI_index');
=======
Route::get('/UIDetailsHebergement-{id}', [HebergementController::class, 'detailsHebergement'])->name('hebergement.details'); 
Route::get('/UIhebergements', [HebergementController::class, 'UI_index'])->name('hebergement.UI_index');  
>>>>>>> 73d994c4ffe6b352ffeb00f5b6cc457bb0e2482d

Route::post('/reservations', [ReservationsHebergementController::class, 'store'])->name('reservations.store');
Route::get('/BOReservations', [ReservationsHebergementController::class, 'index_BackOffice'])->name('reservations.index_BackOffice');
Route::get('/MyReservations', [ReservationsHebergementController::class, 'index'])->name('reservations.index');
Route::get('/reservations-{reservation}-payment', [ReservationsHebergementController::class, 'showPaymentForm'])->name('reservations.payment');
Route::post('/reservations/{reservation}/createPaymentIntent', [ReservationsHebergementController::class, 'createPaymentIntent'])
    ->name('reservations.createPaymentIntent');
Route::get('/reservations-{id}', [ReservationsHebergementController::class, 'show'])->name('reservations.details');
<<<<<<< HEAD
Route::get('/reservations/{id}/delete', [ReservationsHebergementController::class, 'delete'])->name('reservations.delete');
=======
Route::get('/reservations/{id}/delete', [ReservationsHebergementController::class, 'delete'])->name('reservations.delete');	
>>>>>>> 73d994c4ffe6b352ffeb00f5b6cc457bb0e2482d

use App\Http\Controllers\ReservationActiviteController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\AvisRestaurantController;
use App\Http\Controllers\ReservationRestaurantController;

Route::get('/guide-list', [GuidesLocauxController::class, 'index'])->name('guidelocal.list');
Route::get('/guide-add', [GuidesLocauxController::class, 'create'])->name('guidelocal.add');
Route::post('/guide-store', [GuidesLocauxController::class, 'store'])->name('guidelocal.store');
Route::delete('/guide/{id}', [GuidesLocauxController::class, 'destroy'])->name('guidelocal.delete');
Route::get('/guide-edit-{id}', [GuidesLocauxController::class, 'edit'])->name('guidelocal.edit');
Route::put('/guide/update/{id}', [GuidesLocauxController::class, 'update'])->name('guidelocal.update');
Route::get('/guide-details-{id}', [GuidesLocauxController::class, 'show'])->name('guidelocal.show');



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
