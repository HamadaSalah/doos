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
        Schema::create('maintains', function (Blueprint $table) {
            $table->id();
            $table->string('amount');
            $table->date('date');
            $table->text('description')->nullable();
            $table->string('status')->nullable()->default(0);
            $table->foreignId('car_id')->constrained('cars')->onDelete('CASCADE');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintains');
    }
};
