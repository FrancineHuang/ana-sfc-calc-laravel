<?php

namespace App\Services;

use App\Models\Flight;
use Illuminate\Support\Facades\DB;
use Exception;

class FlightService {

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
}