<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

Route::post('auth/register', [AuthController::class, 'register']);
Route::post('auth/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    Route::get('auth/profile', [AuthController::class, 'profile']);
    Route::get('auth/logout', [AuthController::class, 'logout']);

    Route::apiResource('v1/clients', ClientController::class);
    Route::apiResource('v1/budgets', BudgetController::class);
    Route::apiResource('v1/projects', ProjectController::class);
    
});
