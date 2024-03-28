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
        Schema::create('car_rent_type', function (Blueprint $table) {
            $table->id();
            $table->unsignedBiginteger('car_id');
            $table->unsignedBiginteger('rent_type_id');
            $table->foreign('car_id')->references('id')
                 ->on('cars')->onDelete('cascade');
            $table->foreign('rent_type_id')->references('id')
                ->on('rent_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_rent_type');
    }
};
