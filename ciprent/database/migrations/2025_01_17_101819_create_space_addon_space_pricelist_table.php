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
        Schema::create('space_addon_space_pricelists', function (Blueprint $table) {
            $table->foreignUlid("space_pricelist_id")->references('id')->on('space_pricelists')->onDelete('cascade');
            $table->foreignUlid("space_addon_id")->references('id')->on('space_addons')->onDelete('cascade');
            $table->primary(['space_addon_id', 'space_pricelist_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('space_pricelist_addons');
    }
};
