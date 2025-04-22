<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AirportsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csvPath = storage_path('app/data/airports_masterdata.csv');
        $csvData = array_map('str_getcsv', file($csvPath));

        $headers = array_shift($csvData);

        foreach($csvData as $row) {
            DB::table('airports')->insert([
                'city_name' => $row[1],
                'iata_code' => $row[2],
                'icao_code' => $row[3],
                'airport_name_ja' => $row[4],
                'airport_name_zh' => $row[5],
                'airport_name_en' => $row[6],
                'airport_type' => (int)$row[7],
                'is_ana_destination' => (bool)$row[8],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        
    }
}
