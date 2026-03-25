<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Candidature extends Model
{
    protected $fillable = [
        'project_id',
        'nom',
        'prenom',
        'email',
        'telephone',
        'lettre_motivation',
        'cv_path',
        'statut',
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
