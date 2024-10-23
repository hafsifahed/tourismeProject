<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\ResetPassword;
use App\Http\Controllers\ChangePassword;
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
