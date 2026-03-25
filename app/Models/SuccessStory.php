<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SuccessStory extends Model
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
        return $this->hasMany(SuccessStoryImage::class);
    }

    public function coverImage(): BelongsTo
    {
        return $this->belongsTo(SuccessStoryImage::class, 'imageId');
    }
}
