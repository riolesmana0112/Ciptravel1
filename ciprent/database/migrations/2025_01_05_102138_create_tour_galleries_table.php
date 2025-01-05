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
        Schema::create('tour_galleries', function (Blueprint $table) {
                 $table->ulid('id')->primary();
            $table->foreignUlid('tour_detail_id')
                ->references('id')
                ->on('tour_details')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->string('path');
            $table->string('path_name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tour_galleries');
    }
};
