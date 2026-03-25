<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResourceItem extends Model
{
    protected $table = 'resources';

    protected $fillable = [
        'titre',
        'description',
        'categorie',
        'file_path',
        'file_name',
        'file_type',
        'datePublication',
    ];

    protected $casts = [
        'datePublication' => 'date',
    ];
}
