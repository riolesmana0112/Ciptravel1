<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal',
        'nama_requestor',
        'jenis_kendaraan',
        'plat_nomor',
        'jenis_maintenance',
        'biaya',
        'vendor',
        'nomor_rekening',
        'keterangan',
        'approval_status',
    ];
}
