<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('front_office_settings', function (Blueprint $table) {
            $table->string('company_slogan_en')->nullable()->after('company_slogan');
            $table->string('company_slogan_pt')->nullable()->after('company_slogan_en');
            $table->string('hero_title_en')->nullable()->after('hero_title');
            $table->string('hero_title_pt')->nullable()->after('hero_title_en');
            $table->text('hero_subtitle_en')->nullable()->after('hero_subtitle');
            $table->text('hero_subtitle_pt')->nullable()->after('hero_subtitle_en');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('front_office_settings', function (Blueprint $table) {
            $table->dropColumn([
                'company_slogan_en', 'company_slogan_pt',
                'hero_title_en', 'hero_title_pt',
                'hero_subtitle_en', 'hero_subtitle_pt',
            ]);
        });
    }
};
