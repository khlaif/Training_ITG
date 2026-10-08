<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\LoginController;


Route::get('/', function () {
    return view('home');
})->name('home');


Route::get('/register', [AuthController::class, 'showRegister'])
    ->name('register');

Route::post('/register', [AuthController::class, 'register'])
    ->name('register.store');


Route::get('/login', [LoginController::class, 'show'])
    ->name('login');

Route::post('/login', [LoginController::class, 'login'])
    ->name('login.store');


Route::post('/logout', [LoginController::class, 'logout'])
    ->name('logout');


Route::middleware('auth')->group(function () {

    Route::get('/trainer/dashboard', function () {

        if (auth()->user()->role !== 'trainer') {
            return redirect()->route('player.dashboard');
        }

        return view('dashboards.trainer');

    })->name('trainer.dashboard');


    Route::get('/player/dashboard', function () {

        if (auth()->user()->role !== 'player') {
            return redirect()->route('trainer.dashboard');
        }

        return view('dashboards.player');

    })->name('player.dashboard');

});
