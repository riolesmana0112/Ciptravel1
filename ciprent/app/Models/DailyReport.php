<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal', 
        'driver_name', 
        'jenis_kendaraan', 
        'plat_nomor', 
        'keberangkatan', 
        'kepulangan', 
        'tujuan'
    ];
}
