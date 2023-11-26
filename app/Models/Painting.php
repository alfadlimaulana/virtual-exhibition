<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
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

    protected $attributes = [
        'status' => 'on review',
    ];

    //scope
    public function scopeFilter(Builder $query, array $request): void
    {
        // dd($request['category']);
        $query->when($request['keyword'] ?? false, function ($query, $keyword) {
            return $query->where('title', 'LIKE', '%'.$keyword.'%')
                ->orWhereHas('user', function ($query) use ($keyword) {
                    $query->where('name', 'LIKE', '%'.$keyword.'%');
                }
            );
        });

        $query->when($request['liked'] ?? false, function ($query) {
            return $query->whereHas('likedPaintings', function ($query) {
                $query->where('user_id', '=', auth()->user()->id);
            });
        });

        $query->when($request['category'] ?? false, function ($query, $category) {
            return $query->whereIn('category', $category);
        });

        $query->when($request['material'] ?? false, function ($query, $material) {
            return $query->whereIn('material', $material);
        });
    }

    // relations
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function likedPaintings(): HasMany
    {
        return $this->hasMany(LikedPainting::class);
    }

    public function feedbacks(): HasMany
    {
        return $this->hasMany(Feedback::class);
    }

    public function paintingImages(): HasMany
    {
        return $this->hasMany(PaintingImage::class);
    }
}