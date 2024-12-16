<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('maintenances', function (Blueprint $table) {
            $table->string('nomor_rekening', 30)->after('vendor'); // Tambahkan kolom nomor rekening
        });
    }
    
    public function down()
    {
        Schema::table('maintenances', function (Blueprint $table) {
            $table->dropColumn('nomor_rekening'); // Hapus kolom nomor rekening
        });
    }
    
};
