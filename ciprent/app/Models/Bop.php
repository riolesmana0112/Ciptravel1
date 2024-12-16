<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bop extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'bop';

    // Jika ada kolom yang di-fillable
    protected $fillable = [
        'tanggal',
        'nama_driver',
        'jenis_kendaraan',
        'plat_nomor',
        'tujuan',
        'keberangkatan',
        'kepulangan',
        'harga',
        'approval_status',
        'nomor_rekening',
    ];
}
