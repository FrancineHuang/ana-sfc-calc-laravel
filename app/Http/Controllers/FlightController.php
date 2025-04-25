<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFlightRequest;
use App\Models\Flight;
use App\Services\FlightService;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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

    /**
     * Show specific flights data
     */
    public function show(int $id) {
        
        try {
            $flight = $this->flightService->getFlightById($id);
            
            // get specific flight through FlightService by id
            return response()->json([
                'status' => 'success',
                'data' => $flight
            ]);
        } catch (ModelNotFoundException $e) {
            // if the flight does not exists
            return response()->json([
                'status' => 'error',
                'message' => 'フライトが見つかりませんでした。'
            ], 404);
        } catch (Exception $e) {
            // other error handling
            return response()->json([
                'status' => 'error',
                'message' => 'エラーが発生しました。' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Delete specific flight data
     */
    public function destroy(int $id) {
        try {
            $flight = $this->flightService->deleteFlight($id);

            return response()->json([
                'status' => 'success',
                'message' => 'フライトのデータが正常に削除されました。'
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'フライトが見つかりませんでした。'
            ], 404);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'エラーが発生しました。' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Restore specific flight data
     */
    public function restore(int $id) {
        try {
            // restore the flight by id
            $result = $this->flightService->restoreFlight($id);

            return response()->json([
                'status' => 'success',
                'message' => 'フライトのデータが正常に復元されました'
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => '削除されたフライトが見つかりませんでした。'
            ], 404);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'エラーが発生しました。' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get all deleted flight data
     */
    public function trashed() {
        try {
            $flights = $this->flightService->getTrashedFlights();

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
