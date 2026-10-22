<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PlayerController;
use App\Http\Resources\UserResource;
use App\Http\Controllers\Api\MatchController;

// API Authentication
Route::post('/login', [AuthController::class, 'login']);

// Protected API Routes
Route::middleware('auth:sanctum')->group(function () {

    // Current authenticated user
    Route::get('/user', function (Request $request) {
        return new UserResource($request->user());
    });

    // Logout
    Route::post('/logout', [AuthController::class, 'logout']);

    // Player API - Read
    Route::get('/players', [PlayerController::class, 'index']);
    Route::get('/players/{player}', [PlayerController::class, 'show']);

    // Player API - Trainer only
    Route::middleware('trainer')->group(function () {

        Route::post('/players', [PlayerController::class, 'store']);
        Route::put('/players/{player}', [PlayerController::class, 'update']);
        Route::patch('/players/{player}', [PlayerController::class, 'update']);
        Route::delete('/players/{player}', [PlayerController::class, 'destroy']);

        Route::post('/matches', [MatchController::class, 'store']);
        Route::put('/matches/{match}', [MatchController::class, 'update']);
        Route::patch('/matches/{match}', [MatchController::class, 'update']);
        Route::delete('/matches/{match}', [MatchController::class, 'destroy']);

        Route::post('/matches/{match}/players', [
            MatchController::class,
            'assignPlayers'
        ]);

    });

    Route::get('/matches', [MatchController::class, 'index']);
    Route::get('/matches/{match}', [MatchController::class, 'show']);

});
