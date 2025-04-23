<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FlightController;

// API Routes
Route::prefix('api')->group(function() {
  Route::post('/flights', [FlightController::class, 'store']);
});