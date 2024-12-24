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
        Schema::create('price_lists', function (Blueprint $table) {
            $table->ulid('id');
            $table->foreignUlid('vehicle_id')
                ->references('id')
                ->on('master_vehicles')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreignUlid('pickup_id')
                ->references('id')
                ->on('mater_pickups')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreignUlid('driop_id')
                ->references('id')
                ->on('mater_drops')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->double('price');
            $table->double('charge_per_hour')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('price_lists');
    }
};
