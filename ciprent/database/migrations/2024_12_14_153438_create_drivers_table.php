<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDriverTable extends Migration
{
    public function up()
    {
        Schema::create('driver', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->date('tanggal');
            $table->string('mobil');
            $table->string('plat_nomor');
            $table->string('jemput');
            $table->string('drop_off');
            $table->dateTime('berangkat'); // Diisi manual
            $table->dateTime('pulang'); // Diisi manual
            $table->string('tujuan');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('driver');
    }
}

