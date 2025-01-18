<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpaceAddonSpacePricelist extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = [
        'space_pricelist_id',
        'space_addon_id',
    ];
}
