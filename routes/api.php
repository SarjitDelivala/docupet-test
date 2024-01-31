<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware([])->group(function () {
    Route::apiResource('pet-types', \App\Http\Controllers\Api\PetTypeController::class)->only(['index']);
    Route::apiResource('pets', \App\Http\Controllers\Api\PetController::class)->only(['index', 'store']);
    Route::apiResource('breeds', \App\Http\Controllers\Api\BreedController::class)->only(['index']);
});
