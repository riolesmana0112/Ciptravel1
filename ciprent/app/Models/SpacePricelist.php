<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class SpacePricelist extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = ['space_detail_id', 'price'];

    function detail(): BelongsTo
    {
        return self::belongsTo(SpaceDetail::class, 'space_detail_id', 'id');
    }

    function addon(): BelongsToMany
    {
        return $this->belongsToMany(SpaceAddon::class, 'space_addon_space_pricelists', 'space_pricelist_id', 'space_addon_id');
    }
}
