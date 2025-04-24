<?php

namespace App\Services;

use App\Models\Flight;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

class FlightService {

    /**
     *  Get all flight index data
     *
     *  @return Collection
     * 
     */
    public function getAllFlights(): Collection {
        return Flight::orderByDesc('boarding_date')->get();
    }

    /**
     * Show one specific flight data
     *
     * @param int $id
     * @return Flight
     * @throws ModelNotFoundException
     */
    public function getFlightById(int $id) {
        return Flight::findOrFail($id);
    }

    /**
     *  Create new flight data
     *
     *  @param array $data Validated Flight Data
     *  @return Flight
     *  @throws Exception
     */
    public function createFlight (array $data) {
        // Calculate unit price of premium points
        return DB::transaction(function () use ($data) {
            if (!isset($data['pp_unitprice']) && isset($data['ticket_price']) && isset($data['earned_pp']) && $data['earned_pp'] > 0) {
                $data['pp_unitprice'] = $data['ticket_price'] / $data['earned_pp'];
            }

            $flight = Flight::create($data);

            return $flight;
        });
    }

    /**
     *
     * Delete existed flight data by id
     * 
     *  @param array $data Validated Flight Data
     *  @return Flight
     *  @throws Exception
     */
    public function deleteFlight(int $id): bool {
        // Find flight data by id.
        $flight = Flight::findOrFail($id);

        return $flight->delete();
    }
}