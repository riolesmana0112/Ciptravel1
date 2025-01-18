<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TourDetail extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = [
        'tour_title',
        'start_date',
        'end_date',
        'pickup',
        'pickup_name',
        'map_location',
        'description',
        'fasilities',
        'days',
        'price'
    ];

    function gallery(): HasMany
    {
        return self::hasMany(TourGallery::class);
    }

    function itenary(): HasMany
    {
        return self::hasMany(Itenary::class);
    }
}
