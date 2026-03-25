<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
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
        return $this->hasMany(ArticleImage::class);
    }

    public function coverImage(): BelongsTo
    {
        return $this->belongsTo(ArticleImage::class, 'imageId');
    }
}
