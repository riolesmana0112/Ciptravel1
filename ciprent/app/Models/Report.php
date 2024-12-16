<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $table = 'reports'; // Pastikan sesuai dengan nama tabel

    // Kolom yang boleh diisi secara massal (mass assignment)
    protected $fillable = [
        'tanggal',
        'nama_driver',
        'jenis_kendaraan',
        'plat_nomor',
        'tujuan',
        'keberangkatan',
        'kepulangan',
        'type_sewa',
        'keterangan_type',
        'harga_sewa',
        'dp',
        'bukti_pembayaran',
        'approval_status',
    ];

}
