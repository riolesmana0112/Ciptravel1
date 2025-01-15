<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterTour extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = ['product_name', 'product_type'];
}
