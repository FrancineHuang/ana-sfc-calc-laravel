<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FlightController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

/**
 * Flight Related API Routes
 */

// Specific Route
Route::get('flights/trashed', [FlightController::class, 'trashed']);
Route::post('flights/{id}/restore', [FlightController::class, 'restore']);

// General Route
Route::post('flight', [FlightController::class, 'store'])->withoutMiddleware('auth:sanctum');
Route::get('flights', [FlightController::class, 'index']);
Route::get('flights/{id}', [FlightController::class, 'show']);
Route::delete('flights/{id}', [FlightController::class, 'destroy']);
