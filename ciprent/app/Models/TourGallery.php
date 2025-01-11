<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourGallery extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = ['tour_detail_id', 'path', 'path_name'];
}
