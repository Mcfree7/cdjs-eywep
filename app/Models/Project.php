<?php

namespace App\Models;

use App\Models\Concerns\HasAutoTranslation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Project extends Model
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
        'statut',
        'tdr_path',
        'date_cloture',
    ];

    protected $casts = [
        'datePublication' => 'date',
        'date_cloture'    => 'date',
    ];

    protected static function booted(): void
    {
        static::creating(function (Project $project) {
            $project->uuid = (string) Str::uuid();
        });
    }

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
        return $this->hasMany(ProjectImage::class);
    }

    public function coverImage(): BelongsTo
    {
        return $this->belongsTo(ProjectImage::class, 'imageId');
    }

    public function candidatures(): HasMany
    {
        return $this->hasMany(Candidature::class);
    }
}
