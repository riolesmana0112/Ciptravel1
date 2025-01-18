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
        Schema::create('space_details', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('space_title');
            $table->smallInteger('days');
            $table->string('location');
            $table->text('google_location');
            $table->text('description');
            $table->double('price');
            $table->text('fasilities');
            $table->integer('min_pax');
            $table->integer('max_pax');
            $table->boolean('available');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('space_details');
    }
};
