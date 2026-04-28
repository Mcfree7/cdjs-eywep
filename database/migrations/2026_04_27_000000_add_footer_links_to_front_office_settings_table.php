<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('front_office_settings', function (Blueprint $table) {
            $table->json('footer_links')->nullable()->after('social_whatsapp');
        });
    }

    public function down(): void
    {
        Schema::table('front_office_settings', function (Blueprint $table) {
            $table->dropColumn('footer_links');
        });
    }
};
