<?php

use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;


// API Routes
Route::prefix('v1')->group(function () {
    // Status
    Route::get('/status', fn() => response()->json([
        'message' => 'API is UP'
    ], 200));

    // Project Routes
    Route::apiResource('projects', ProjectController::class);
});
