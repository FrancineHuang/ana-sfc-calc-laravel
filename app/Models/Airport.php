<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Airport extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded =[];

    protected $casts = [
      'airport_type' => 'integer',
      'is_ana_destination' => 'boolean',
    ];

    public function departureFlights() {
      return $this->hasMany(Flight::class, 'departure', 'iata_code');
    }

    public function destinationFlights() {
      return $this->hasMany(Flight::class, 'destination', 'iata_code');
    }
}
