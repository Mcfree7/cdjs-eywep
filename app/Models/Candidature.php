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
        'pays',
        'sexe',
        'email',
        'telephone',
        'lettre_motivation',
        'lettre_motivation_path',
        'cv_path',
        'piece_identite_path',
        'business_plan_path',
        'plan_financier_path',
        'documents_legaux_path',
        'autres_activites_path',
        'statut',
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
