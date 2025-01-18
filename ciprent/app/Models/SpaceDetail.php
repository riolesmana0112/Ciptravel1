<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SpaceDetail extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = [
        'space_title',
        'location',
        'google_location',
        'description',
        'fasilities',
        "min_pax",
        "max_pax",
        "available",
        'days',
        'price'
    ];

    function gallery(): HasMany
    {
        return self::hasMany(SpaceGallery::class);
    }

    function itenary(): HasMany
    {
        return self::hasMany(SpaceItenary::class);
    }
}
