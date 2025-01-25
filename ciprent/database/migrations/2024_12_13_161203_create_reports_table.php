<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('nama_driver');
            $table->string('jenis_kendaraan');
            $table->string('plat_nomor');
            $table->string('tujuan');
            $table->timestamp('keberangkatan');
            $table->timestamp('kepulangan');
            $table->string('type_sewa');
            $table->text('keterangan_type');
            $table->decimal('harga_sewa', 10, 2);
            $table->decimal('dp', 10, 2);
            $table->string('bukti_pembayaran')->nullable(); // Menyimpan path file bukti pembayaran
            $table->boolean('approval_status')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reports');
    }
}
