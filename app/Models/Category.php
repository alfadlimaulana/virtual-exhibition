<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory, HasUuids;
    protected $guarded = [
        'id',
    ];

    // relations
    public function paintingCategory(): HasMany
    {
        return $this->hasMany(LikedPaintings::class);
    }
}