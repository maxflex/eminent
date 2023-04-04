<?php

use App\Http\Controllers\{AuthController, PlanController};
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->prefix('auth')->group(function () {
    Route::post('login', 'login');
    // Route::get('user', 'user');
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('auth/user', [AuthController::class, 'user']);
    Route::apiResource('plans', PlanController::class);
});
