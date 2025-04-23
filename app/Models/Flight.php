<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Flight extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'boarding_date',
        'departure',
        'destination',
        'flight_number',
        'ticket_price',
        'fare_type',
        'other_expenses',
        'earned_pp',
        'pp_unitprice', 
        'status',
    ];

    protected $casts = [
        'boarding_date' => 'date',
        'ticket_price' => 'integer',
        'other_expenses' => 'integer',
        'earned_pp' => 'integer',
        'status' => 'boolean',
        'pp_unitprice' => 'decimal:2',
    ];

    public function departureAirport() {
        return $this->belongsTo(Airport::class, 'departure', 'iata_code');
    }

    public function destinationFlight() {
        return $this->belongsTo(Airport::class, 'destination', 'iata_code');
    }
}
