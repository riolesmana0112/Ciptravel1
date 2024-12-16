<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDailyReportsTable extends Migration
{
    public function up()
    {
        Schema::create('daily_reports', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');  // Tanggal laporan
            $table->string('driver_name');  // Nama driver
            $table->string('vehicle_type');  // Jenis kendaraan
            $table->string('plat_nomor');  // Plat nomor
            $table->datetime('keberangkatan');  // Tanggal dan jam keberangkatan
            $table->datetime('kepulangan');  // Tanggal dan jam kepulangan
            $table->string('tujuan');  // Tujuan
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('daily_reports');
    }
}
