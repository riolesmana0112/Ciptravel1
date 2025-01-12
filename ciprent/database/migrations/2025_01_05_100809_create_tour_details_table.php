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
        Schema::create('tour_details', function (Blueprint $table) {
                $table->ulid('id')->primary();
                $table->string('tour_title');
                $table->date('start_date');
                $table->date('end_date');
                $table->smallInteger('days');
                $table->string('pickup');
                $table->string('pickup_name');
                $table->text('map_location');
                $table->text('description');
                $table->double('price');
                $table->foreignUlid('master_tour_id')
                    ->references('id')
                    ->on('master_tours')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
                $table->text('fasilities');
                $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tour_details');
    }
};
