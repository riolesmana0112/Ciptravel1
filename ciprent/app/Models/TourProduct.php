<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class TourProduct extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = [
        'master_tour_id',
        'tour_detail_id',
    ];

    function type(): BelongsTo
    {
        return $this->belongsTo(MasterTour::class, 'master_tour_id', 'id');
    }

    function detail(): HasOne
    {
        return $this->HasOne(TourDetail::class, 'id' , 'tour_detail_id');
    }
}
