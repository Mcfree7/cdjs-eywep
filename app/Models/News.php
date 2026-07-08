<?php

namespace App\Models;

use App\Models\Concerns\HasAutoTranslation;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasAutoTranslation;

    protected array $translatable = ['titre'];

    protected $fillable = [
        'titre',
        'titre_en',
        'titre_pt',
        'status',
    ];

    public function translatedTitre(): string
    {
        return $this->translated('titre') ?? $this->titre;
    }
}
