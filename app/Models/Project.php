<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Project extends Model
{
    protected $fillable = [
        'titre',
        'description',
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
