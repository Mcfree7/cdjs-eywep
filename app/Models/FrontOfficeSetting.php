<?php

namespace App\Models;

use App\Models\Concerns\HasAutoTranslation;
use Illuminate\Database\Eloquent\Model;

class FrontOfficeSetting extends Model
{
    use HasAutoTranslation;

    protected array $translatable = ['company_slogan', 'hero_title', 'hero_subtitle'];

    protected $fillable = [
        'company_name',
        'company_slogan',
        'company_slogan_en',
        'company_slogan_pt',
        'company_logo_path',
        'primary_color',
        'hero_images',
        'hero_video_file_path',
        'hero_video_url',
        'hero_title',
        'hero_title_en',
        'hero_title_pt',
        'hero_subtitle',
        'hero_subtitle_en',
        'hero_subtitle_pt',
        'company_address',
        'company_location',
        'company_phone',
        'company_email',
        'social_facebook',
        'social_linkedin',
        'social_twitter',
        'social_whatsapp',
        'footer_links',
    ];

    protected $casts = [
        'hero_images'   => 'array',
        'footer_links'  => 'array',
    ];
}
