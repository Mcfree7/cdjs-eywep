<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Activity extends Model
{
    protected $fillable = [
        'titre',
        'description',
        'imageId',
        'datePublication',
    ];

    protected $casts = [
        'datePublication' => 'date',
    ];

    public function images(): HasMany
    {
        return $this->hasMany(ActivityImage::class);
    }

    public function coverImage(): BelongsTo
    {
        return $this->belongsTo(ActivityImage::class, 'imageId');
    }
}
