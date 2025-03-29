<?php

use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('projects', [ProjectController::class, 'index'])->name('projects.index');
    Route::get('projects/create', [ProjectController::class, 'create'])->name('projects.create');
    Route::get('projects/{id}', [ProjectController::class, 'show'])->name('projects.show');
    Route::get('projects/{id}/edit', [ProjectController::class, 'edit'])->name('projects.edit');

    Route::post('projects', [ProjectController::class, 'store'])->name('projects.store');
    Route::put('projects/{id}', [ProjectController::class, 'update'])->name('projects.update');
    Route::delete('projects/{id}', [ProjectController::class, 'destroy'])->name('projects.destroy');
});
