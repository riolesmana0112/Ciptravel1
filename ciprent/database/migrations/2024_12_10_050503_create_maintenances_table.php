<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaintenancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maintenances', function (Blueprint $table) {
            $table->id(); // Auto-increment primary key
            $table->date('tanggal'); // Tanggal untuk pemeliharaan
            $table->string('nama_requestor', 255); // Nama peminta pemeliharaan
            $table->string('jenis_kendaraan', 100); // Jenis kendaraan
            $table->string('plat_nomor', 50); // Nomor plat kendaraan
            $table->string('jenis_maintenance', 100); // Jenis pemeliharaan
            $table->decimal('biaya', 15, 2); // Biaya pemeliharaan
            $table->string('vendor', 255); // Nama vendor
            $table->text('keterangan')->nullable(); // Keterangan tambahan
            $table->boolean('approval_status')->default(false); // Status approval
            $table->timestamps(); // Timestamps untuk created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('maintenances');
    }
}
