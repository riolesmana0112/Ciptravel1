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
        Schema::create('tour_products', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->ulid('master_tour_id')->references('id')->on('master_tours')->onDelete('cascade');
            $table->ulid('tour_detail_id')->references('id')->on('tour_details')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tour_products');
    }
};
