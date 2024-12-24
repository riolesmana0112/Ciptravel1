<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterVehicle extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = ['vehicle_type', 'vehicle_name', 'vehicle_number', 'vehicle_picture', 'vehicle_path'];
}
