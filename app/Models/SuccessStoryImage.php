<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SuccessStoryImage extends Model
{
    protected $fillable = [
        'success_story_id',
        'image_path',
    ];

    public function successStory(): BelongsTo
    {
        return $this->belongsTo(SuccessStory::class);
    }
}
