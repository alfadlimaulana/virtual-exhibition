<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Painting extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = [
        'id',
    ];

    // relations
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function likedPaintings(): HasMany
    {
        return $this->hasMany(LikedPaintings::class);
    }

    public function paintingImages(): HasMany
    {
        return $this->hasMany(PaintingImage::class);
    }

    public function paintingCategories(): HasMany
    {
        return $this->hasMany(PaintingCategory::class);
    }
}
