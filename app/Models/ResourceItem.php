<?php

namespace App\Models;

use App\Models\Concerns\HasAutoTranslation;
use Illuminate\Database\Eloquent\Model;

class ResourceItem extends Model
{
    use HasAutoTranslation;

    protected $table = 'resources';

    protected array $translatable = ['titre', 'description'];

    protected $fillable = [
        'titre',
        'titre_en',
        'titre_pt',
        'description',
        'description_en',
        'description_pt',
        'categorie',
        'file_path',
        'file_name',
        'file_type',
        'file_titre',
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

    public function files()
    {
        return $this->hasMany(ResourceFile::class, 'resource_item_id');
    }
}
