<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PaintingImage extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = [
        'id',
    ];

    public function painting(): BelongsTo
    {
        return $this->belongsTo(Painting::class);
    }
}
