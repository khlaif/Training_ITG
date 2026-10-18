<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\MatchController;
use App\Http\Controllers\PlayerDashboardController;

// Home Page
Route::get('/', function () {
    return view('home');
})->name('home');


// Guest Routes (Sign Up / Sign In)
Route::middleware('guest')->group(function () {

    Route::get('/register', [AuthController::class, 'showRegister'])
        ->name('register');

    Route::post('/register', [AuthController::class, 'register'])
        ->name('register.store');

    Route::get('/login', [LoginController::class, 'show'])
        ->name('login');

    Route::post('/login', [LoginController::class, 'login'])
        ->name('login.store');

});


// Logout
Route::post('/logout', [LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');


// Trainer Dashboard
Route::middleware(['auth', 'trainer'])->group(function () {

    Route::get('/trainer/dashboard', function () {
        return view('dashboards.trainer');
    })->name('trainer.dashboard');

    // Player Management (Task 3)
    Route::resource('players', PlayerController::class)
        ->except(['show']);

    // Match Management (Task 4)
    Route::resource('matches', MatchController::class);

});


// Player Routes (Task 5)
Route::middleware(['auth', 'player'])->group(function () {

    // Player Dashboard
    Route::get('/player/dashboard', [
        PlayerDashboardController::class,
        'dashboard'
    ])->name('player.dashboard');

    // My Profile
    Route::get('/player/profile', [
        PlayerDashboardController::class,
        'profile'
    ])->name('player.profile');

    // My Matches
    Route::get('/player/matches', [
        PlayerDashboardController::class,
        'matches'
    ])->name('player.matches');

    // Match Details
    Route::get('/player/matches/{match}', [
        PlayerDashboardController::class,
        'matchDetails'
    ])->name('player.matches.show');

});
