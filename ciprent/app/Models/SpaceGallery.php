<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpaceGallery extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = ['space_detail_id', 'path', 'path_name'];
}
