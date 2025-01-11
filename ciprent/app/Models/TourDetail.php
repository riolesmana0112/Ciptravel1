<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'days'
    ];
    
    function masterTour()
    {
        return $this->belongsTo(MasterTour::class);
    }

    function gallery()
    {
        return $this->hasMany(TourGallery::class, 'tour_detail_id', 'id');
    }
}
