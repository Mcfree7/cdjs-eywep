<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    protected $fillable = [
        'titre',
        'description',
        'imageId',
        'datePublication',
        'statut',
    ];

    protected $casts = [
        'datePublication' => 'date',
    ];

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
