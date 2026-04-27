<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('front_office_settings', function (Blueprint $table) {
            $table->string('social_facebook')->nullable()->after('company_email');
            $table->string('social_linkedin')->nullable()->after('social_facebook');
            $table->string('social_twitter')->nullable()->after('social_linkedin');
            $table->string('social_whatsapp')->nullable()->after('social_twitter');
        });
    }

    public function down(): void
    {
        Schema::table('front_office_settings', function (Blueprint $table) {
            $table->dropColumn(['social_facebook', 'social_linkedin', 'social_twitter', 'social_whatsapp']);
        });
    }
};
