<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
        'master_tour_id',
        'days',
        'price'
    ];
    
    function tour(): BelongsTo
    {
        return $this->belongsTo(MasterTour::class, 'master_tour_id', 'id')->select("id", "product_name");
    }

    function gallery(): HasMany
    {
        return self::hasMany(TourGallery::class);
    }

    function itenary(): HasMany
    {
        return self::hasMany(Itenary::class);
    }
}
