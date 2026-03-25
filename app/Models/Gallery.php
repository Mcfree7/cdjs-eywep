<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Gallery extends Model
{
    protected $fillable = [
        'titre',
    ];

    public function medias(): HasMany
    {
        return $this->hasMany(GalleryMedia::class);
    }
}
