<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFlightRequest;
use App\Services\FlightService;

class FlightController extends Controller
{
    protected $flightService;

    public function __construct(FlightService $flightService) {
        $this->flightService = $flightService;
    }

    public function store(StoreFlightRequest $request) {
        // Request data is validated so that can be used
        $validatedData = $request->validated();

        // Create flight data through FlightService
        $flight = $this->flightService->createFlight($validatedData);

        // Return response
        return response()->json([
          'status' => 'success',
          'message' => 'フライトのデータが作成されました',
          'data' => $flight
        ], 201);
    }
}
