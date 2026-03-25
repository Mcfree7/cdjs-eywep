<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('front_office_settings', function (Blueprint $table) {
            $table->id();
            $table->string('company_name')->nullable();
            $table->string('company_slogan')->nullable();
            $table->string('company_logo_path')->nullable();
            $table->string('primary_color')->nullable();
            $table->json('hero_images')->nullable();
            $table->string('hero_video_file_path')->nullable();
            $table->string('hero_video_url')->nullable();
            $table->string('hero_title')->nullable();
            $table->text('hero_subtitle')->nullable();
            $table->string('company_address')->nullable();
            $table->string('company_location')->nullable();
            $table->string('company_phone')->nullable();
            $table->string('company_email')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('front_office_settings');
    }
};
