<?php

namespace App\Models;

use App\Models\Concerns\HasAutoTranslation;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasAutoTranslation;

    protected array $translatable = ['titre', 'description'];

    protected $fillable = [
        'titre',
        'titre_en',
        'titre_pt',
        'description',
        'description_en',
        'description_pt',
        'imageId',
        'datePublication',
    ];

    protected $casts = [
        'datePublication' => 'date',
    ];

    public function translatedTitre(): string
    {
        return $this->translated('titre') ?? $this->titre;
    }

    public function translatedDescription(): string
    {
        return $this->translated('description') ?? $this->description;
    }

    public function images(): HasMany
    {
        return $this->hasMany(ArticleImage::class);
    }

    public function coverImage(): BelongsTo
    {
        return $this->belongsTo(ArticleImage::class, 'imageId');
    }
}
