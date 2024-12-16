<?php

// app/Models/Driver.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;

    protected $table = 'driver';

    protected $fillable = [
        'nama', 'tanggal', 'mobil', 'plat_nomor', 'jemput', 'drop_off', 'berangkat', 'pulang', 'tujuan'
    ];
}