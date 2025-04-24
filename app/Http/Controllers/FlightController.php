<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFlightRequest;
use App\Services\FlightService;
use Exception;

class FlightController extends Controller
{
    protected $flightService;

    public function __construct(FlightService $flightService) {
        $this->flightService = $flightService;
    }

    /**
     * Create new flight data
     */
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

    /**
     * Get all flights data
     */
    public function index() {
      try {
        // get all flights through FlightService
        $flights = $this->flightService->getAllFlights();

        return response()->json([
          'status' => 'success',
          'data' => $flights
        ]);
      } catch (Exception $e) {
        // Error handling
        return response()->json([
          'status' => 'error',
          'message' => 'エラーが発生しました：' . $e->getMessage()
        ], 500);
      }
    }
}
