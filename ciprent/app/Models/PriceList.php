<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PriceList extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = ['vehicle_id', 'pickup_id', 'driop_id', 'price', 'charge_per_hour', 'description'];

    function vehicle(): HasOne
    {
        return self::hasOne(MasterVehicle::class, 'id', 'vehicle_id')->select('id', 'vehicle_type', 'vehicle_name', 'vehicle_picture');
    }

    function drop_point(): HasOne
    {
        return self::hasOne(MaterDrop::class, 'id', 'driop_id')->select('id', 'drop_name', 'alias');
    }

    function pickup_point(): HasOne
    {
        return self::hasOne(MaterPickup::class, 'id', 'pickup_id')->select('id', 'pickup_name', 'alias');
    }
}
