<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('kendaraan'); // Nama kendaraan
            $table->string('plat_nomor'); // Plat nomor kendaraan
            $table->string('status')->default('available'); // Status kendaraan dengan default 'available'
            $table->string('condition')->nullable(); // Kondisi kendaraan
            $table->text('keterangan')->nullable(); // Keterangan tambahan
            $table->boolean('verified')->default(false); // Status verifikasi
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('cars'); // Menghapus tabel jika rollback migrasi
    }
};
