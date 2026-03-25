<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FrontOfficeSetting extends Model
{
    protected $fillable = [
        'company_name',
        'company_slogan',
        'company_logo_path',
        'primary_color',
        'hero_images',
        'hero_video_file_path',
        'hero_video_url',
        'hero_title',
        'hero_subtitle',
        'company_address',
        'company_location',
        'company_phone',
        'company_email',
    ];

    protected $casts = [
        'hero_images' => 'array',
    ];
}
