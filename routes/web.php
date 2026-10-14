<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\MatchController;

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


// Authenticated User Dashboards
Route::middleware('auth')->group(function () {

    // Trainer Dashboard
    Route::get('/trainer/dashboard', function () {

        if (auth()->user()->role !== 'trainer') {
            return redirect()->route('player.dashboard');
        }

        return view('dashboards.trainer');

    })->name('trainer.dashboard');


    // Player Dashboard
    Route::get('/player/dashboard', function () {

        if (auth()->user()->role !== 'player') {
            return redirect()->route('trainer.dashboard');
        }

        return view('dashboards.player');

    })->name('player.dashboard');

});


Route::middleware(['auth', 'trainer'])->group(function () {

    Route::resource('players', PlayerController::class)
        ->except(['show']);

    Route::resource('matches', MatchController::class);

});

