<?php
use App\Http\Controllers\ActiviteController;
use App\Http\Controllers\AvisActiviteController;


use App\Http\Controllers\AvisTourController;
use App\Http\Controllers\GuideLocalController;
use App\Http\Controllers\HebergementController;
use App\Http\Controllers\ReservationsHebergementController;
use App\Http\Controllers\ReservationTourController;
use App\Http\Controllers\TypeTourController;
use Illuminate\Support\Facades\Route;
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
Route::get('/transport-detail-{id}', [TransportController::class, 'show'])->name('transport.show');
Route::get('/transport-search', [TransportController::class, 'search'])->name('transport.search');
use App\Http\Controllers\MissionVolontariatController;
use App\Http\Controllers\CandidatureVolontariatController; // Import du contrôleur

// Routes pour l'admin - missions
Route::get('/missions-admin', [MissionVolontariatController::class, 'indexAdmin'])->name('missions.indexAdmin');

// Routes pour les utilisateurs - missions
Route::get('/missions', [MissionVolontariatController::class, 'indexUser'])->name('missions.indexUser');

// Routes pour la création, modification, suppression des missions
Route::get('/missions-create', [MissionVolontariatController::class, 'create'])->name('missions.create');
Route::post('/missions', [MissionVolontariatController::class, 'store'])->name('missions.store');
Route::get('/missions-{mission}-edit', [MissionVolontariatController::class, 'edit'])->name('missions.edit');
Route::put('/missions/{mission}', [MissionVolontariatController::class, 'update'])->name('missions.update');
Route::delete('/missions/{mission}', [MissionVolontariatController::class, 'destroy'])->name('missions.destroy');

// Routes pour l'admin - candidatures
Route::get('/candidatures-admin', [CandidatureVolontariatController::class, 'indexAdmin'])->name('candidatures.indexAdmin');

// Routes pour la création, modification, suppression des candidatures
Route::get('/candidatures-create-{mission_id}', [CandidatureVolontariatController::class, 'create'])->name('candidatures.create');

//Route::get('/candidatures/create/{missionId}', [CandidatureVolontariatController::class, 'create'])->name('candidatures.create');


Route::post('/candidatures', [CandidatureVolontariatController::class, 'store'])->name('candidatures.store');
Route::get('/candidatures-{candidature}-edit', [CandidatureVolontariatController::class, 'edit'])->name('candidatures.edit');
Route::put('/candidatures/{candidature}', [CandidatureVolontariatController::class, 'update'])->name('candidatures.update');
Route::delete('/candidatures/{candidature}', [CandidatureVolontariatController::class, 'destroy'])->name('candidatures.destroy');
// Route pour afficher les détails d'une candidature
Route::get('/candidatures/{candidature}', [CandidatureVolontariatController::class, 'show'])->name('candidatures.show');

// Routes pour accepter et refuser une candidature avec des tirets
Route::post('/candidatures-{id}-accepter', [CandidatureVolontariatController::class, 'accepter'])->name('candidatures.accepter');
Route::post('/candidatures-{id}-refuser', [CandidatureVolontariatController::class, 'refuser'])->name('candidatures.refuser');


// Route pour afficher les candidatures de l'utilisateur connecté
Route::get('/candidatures-user', [CandidatureVolontariatController::class, 'indexUser'])->name('candidatures.indexUser')->middleware('auth');


// Location Transport routes
Route::get('/location-list', [LocationController::class, 'index'])->name('location.list');
Route::get('/location-add', [LocationController::class, 'create'])->name('location-transport.create');
Route::post('/location-transport', [LocationController::class, 'store'])->name('location-transport.store');
Route::delete('/location/{id}', [LocationController::class, 'destroy'])->name('location.delete');
Route::get('/location-edit-{id}', [LocationController::class, 'edit'])->name('location.edit');
Route::put('/location-transport/update/{id}', [LocationController::class, 'update'])->name('location-transport.update');


Route::post('/location/louer', [LocationController::class, 'louerTransport'])->name('location.louer');

Route::get('/hebergements', [HebergementController::class,'index'])->name('hebergement.index');
Route::get('/hebergement-create', [HebergementController::class,'create'])->name('hebergement.create');
Route::post('/hebergement-store', [HebergementController::class,'store'])->name('hebergement.store');
Route::delete('/hebergement/{id}', [HebergementController::class,'destroy'])->name('hebergement.destroy');
Route::get('/hebergement-details-{id}', [HebergementController::class,'show'])->name('hebergement.show');
Route::get('/hebergement-edit-{id}', [HebergementController::class,'edit'])->name('hebergement.edit');
Route::put('/hebergement/update/{id}', [HebergementController::class,'update'])->name('hebergement.update');
Route::get('/hebergements-search', [HebergementController::class, 'search'])->name('hebergement.search');
Route::get('/UIDetailsHebergement-{id}', [HebergementController::class, 'detailsHebergement'])->name('hebergement.details');
Route::get('/UIhebergements', [HebergementController::class, 'UI_index'])->name('hebergement.UI_index');

Route::get('/UIDetailsHebergement-{id}', [HebergementController::class, 'detailsHebergement'])->name('hebergement.details');
Route::get('/UIhebergements', [HebergementController::class, 'UI_index'])->name('hebergement.UI_index');

Route::post('/reservations', [ReservationsHebergementController::class, 'store'])->name('reservationsHebergement.store');
Route::get('/BOReservations', [ReservationsHebergementController::class, 'index_BackOffice'])->name('reservations.index_BackOffice');
Route::get('/MyReservationss', [ReservationsHebergementController::class, 'index'])->name('reservationsss.index');
Route::get('/reservations-{reservation}-payment', [ReservationsHebergementController::class, 'showPaymentForm'])->name('reservations.payment');
Route::post('/reservations/{reservation}/createPaymentIntent', [ReservationsHebergementController::class, 'createPaymentIntent'])->name('reservations.createPaymentIntent');
Route::get('/reservations-{id}', [ReservationsHebergementController::class, 'show'])->name('reservations.details');
Route::get('/reservations/{id}/delete', [ReservationsHebergementController::class, 'delete'])->name('reservations.delete');

Route::get('/reservations/{id}/delete', [ReservationsHebergementController::class, 'delete'])->name('reservations.delete');

use App\Http\Controllers\ReservationActiviteController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\AvisRestaurantController;
use App\Http\Controllers\ReservationRestaurantController;
use App\Http\Controllers\UserManagementController;

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

Route::get('/reservationtour-list', [ReservationTourController::class, 'index'])->name('reservationtour.list');
Route::get('/reservationtour-add', [ReservationTourController::class, 'create'])->name('reservationtour.add');
Route::post('/reservationtour-store', [ReservationTourController::class, 'store'])->name('reservationtour.store');
Route::delete('/reservationtour/{id}', [ReservationTourController::class, 'destroy'])->name('reservationtour.delete');
Route::get('/reservationtour-edit-{id}', [ReservationTourController::class, 'edit'])->name('reservationtour.edit');
Route::put('/reservationtour/update/{id}', [ReservationTourController::class, 'update'])->name('reservationtour.update');
Route::get('/reservationtour-details-{id}', [ReservationTourController::class, 'show'])->name('reservationtour.show');

Route::get('/avis-list', [AvisTourController::class, 'index'])->name('avistour.list');
Route::get('/avis-add', [AvisTourController::class, 'create'])->name('avistour.add');
Route::post('/avis-store', [AvisTourController::class, 'store'])->name('avistour.store');
Route::delete('/avis/{id}', [AvisTourController::class, 'destroy'])->name('avistour.delete');
Route::get('/avis-edit-{id}', [AvisTourController::class, 'edit'])->name('avistour.edit');
Route::put('/avis/update/{id}', [AvisTourController::class, 'update'])->name('avistour.update');
Route::get('/avis-details-{id}', [AvisTourController::class, 'show'])->name('avistour.show');



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


Route::get('/users', [UserManagementController::class, 'index'])->name('usersM.index');
Route::delete('/users-{id}', [UserManagementController::class, 'destroy'])->name('users.destroy');
Route::get('/users-{id}-edit', [UserManagementController::class, 'edit'])->name('users.edit');
Route::put('/users-{id}', [UserManagementController::class, 'update'])->name('users.update');
Route::post('/users', [UserManagementController::class, 'store'])->name('users.store');
Route::get('/users-{id}', [UserManagementController::class, 'show'])->name('users.show');

// Other routes (already in your file)
Route::get('/', function () {
    return redirect('/dashboard');
})->middleware('auth');

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
