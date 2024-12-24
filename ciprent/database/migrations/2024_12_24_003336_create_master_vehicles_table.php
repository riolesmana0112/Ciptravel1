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
        Schema::create('master_vehicles', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->enum('vehicle_type', ['CAR', 'HELICOPTER', 'YATCH']);
            $table->string('vehicle_name', 50);
            $table->string('vehicle_number', 20);
            $table->string('vehicle_picture');
            $table->string('vehicle_path');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_vehicles');
    }
};
