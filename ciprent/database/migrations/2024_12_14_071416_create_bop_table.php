<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBopTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bops', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->date('tanggal');
            $table->string('nama_driver');
            $table->string('jenis_kendaraan');
            $table->string('plat_nomor');
            $table->string('tujuan');
            $table->dateTime('keberangkatan');
            $table->dateTime('kepulangan');
            $table->decimal('harga', 15, 2); // Decimal column for monetary values
            $table->boolean('approval_status')->default(false); // Checkbox field
            $table->string('nomor_rekening');
            $table->timestamps(); // Adds created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bops');
    }
}
