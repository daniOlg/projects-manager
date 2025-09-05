<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;


// API Routes
Route::prefix('v1')->group(function () {
    // Status
    Route::get('status', fn() => response()->json([
        'message' => 'API is UP'
    ], 200));

    
    // Auth routes
    Route::post('auth/register', [AuthController::class, 'register']);
    Route::post('auth/login', [AuthController::class, 'login']);

    // Protected routes
    Route::middleware('auth:api')->group(function () {
        // Project routes
        Route::apiResource('projects', ProjectController::class);
    });
});
