<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LikedPainting extends Model
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

    public function painting(): BelongsTo
    {
        return $this->belongsTo(Painting::class);
    }
}