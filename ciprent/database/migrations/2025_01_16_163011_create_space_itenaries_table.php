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
        Schema::create('space_itenaries', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('space_detail_id')
                ->references('id')
                ->on('space_details')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->text('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('space_itenaries');
    }
};
