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
        Schema::create('flights', function (Blueprint $table) {
            $table->id();
            $table->date('boarding_date')->comment('搭乗日');
            $table->string('departure', 3)->comment('出発地のIATAコード');
            $table->string('destination', 3)->comment('目的地のIATAコード');
            $table->string('flight_number', 10)->comment('便名');
            $table->integer('ticket_price')->comment('航空券代');
            $table->string('fare_type', 20)->comment('運賃種類');
            $table->integer('other_expenses')->default(0)->comment('その他費用');
            $table->integer('earned_pp')->comment('獲得PP');
            $table->boolean('status')->default(false)->comment('ステータス');
            $table->decimal('pp_unitprice', 10, 2)->comment('PP単価');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flights');
    }
};
