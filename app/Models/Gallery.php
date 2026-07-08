<?php

namespace App\Models;

use App\Models\Concerns\HasAutoTranslation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Gallery extends Model
{
    use HasAutoTranslation;

    protected array $translatable = ['titre'];

    protected $fillable = [
        'titre',
        'titre_en',
        'titre_pt',
    ];

    public function translatedTitre(): string
    {
        return $this->translated('titre') ?? $this->titre;
    }

    public function medias(): HasMany
    {
        return $this->hasMany(GalleryMedia::class);
    }
}
