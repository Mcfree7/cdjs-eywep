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
        Schema::table('candidatures', function (Blueprint $table) {
            $table->string('pays')->nullable()->after('prenom');
            $table->string('sexe')->nullable()->after('pays'); // homme, femme
            $table->string('piece_identite_path')->nullable()->after('cv_path');
        });
    }

    public function down(): void
    {
        Schema::table('candidatures', function (Blueprint $table) {
            $table->dropColumn(['pays', 'sexe', 'piece_identite_path']);
        });
    }
};
