<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

// API Root
Route::get('/', fn() => response()->json([
    'message' => 'Welcome to the Projects Manager API',
    'docs' => url('/docs/api'),
    'v1' => url('/api/v1'),
]));

// API Routes
Route::prefix('v1')->group(function () {
    // List all API routes
    Route::get('/', fn() => response()->json(getAllRoutes()));

    // Status
    Route::get('status', fn() => response()->json([
        'message' => 'API is UP'
    ], 200));

    // Auth routes
    Route::post('auth/register', [AuthController::class, 'register']);
    Route::post('auth/login', [AuthController::class, 'login']);

    // Protected routes
    Route::middleware('auth:api')->group(function () {
        Route::apiResource('projects', ProjectController::class);
    });
});

function getAllRoutes()
{
    return collect(\Illuminate\Support\Facades\Route::getRoutes())->filter(function ($route) {
        return str_starts_with($route->uri(), 'api/');
    })->map(function ($route) {
        $fullUrl = url($route->uri());
        return [
            'full_url' => $fullUrl,
            'uri' => $route->uri(),
            'methods' => $route->methods(),
        ];
    });
}
