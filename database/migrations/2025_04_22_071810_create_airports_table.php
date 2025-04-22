<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('airports', function (Blueprint $table) {
            $table->id();
            $table->string('city_name')->comment('都市名');
            $table->string('iata_code', 3)->comment('IATAコード');
            $table->string('icao_code', 4)->comment('ICAOコード');
            $table->string('airport_name_ja')->comment('空港名（日本語）');
            $table->string('airport_name_zh')->comment('空港名（中国語）');
            $table->string('airport_name_en')->comment('空港名（英語）');
            $table->tinyInteger('airport_type')->comment('空港タイプ 1: 日本国内 2: 海外');
            $table->boolean('is_ana_destination')->default(true)->comment('ANAの就航先かどうか 0:false 1:true');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('airports');
    }
};
