<?php

namespace App\Models;

use App\Models\Concerns\HasAutoTranslation;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasAutoTranslation;

    protected array $translatable = ['question', 'reponse'];

    protected $fillable = [
        'question',
        'question_en',
        'question_pt',
        'reponse',
        'reponse_en',
        'reponse_pt',
        'ordre',
        'actif',
    ];

    protected $casts = [
        'actif' => 'boolean',
        'ordre' => 'integer',
    ];

    public function scopeActif($query)
    {
        return $query->where('actif', true);
    }
}
