<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('candidatures', function (Blueprint $table) {
            $table->index('statut');
            $table->index('pays');
            $table->index('sexe');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::table('candidatures', function (Blueprint $table) {
            $table->dropIndex(['statut']);
            $table->dropIndex(['pays']);
            $table->dropIndex(['sexe']);
            $table->dropIndex(['created_at']);
        });
    }
};
