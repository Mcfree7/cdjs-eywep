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
        Schema::table('success_stories', function (Blueprint $table) {
            $table->string('titre_en')->nullable()->after('titre');
            $table->string('titre_pt')->nullable()->after('titre_en');
            $table->longText('description_en')->nullable()->after('description');
            $table->longText('description_pt')->nullable()->after('description_en');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('success_stories', function (Blueprint $table) {
            $table->dropColumn(['titre_en', 'titre_pt', 'description_en', 'description_pt']);
        });
    }
};
