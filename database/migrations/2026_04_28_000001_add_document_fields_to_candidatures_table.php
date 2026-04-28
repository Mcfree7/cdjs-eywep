<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('candidatures', function (Blueprint $table) {
            $table->string('business_plan_path')->nullable()->after('piece_identite_path');
            $table->string('plan_financier_path')->nullable()->after('business_plan_path');
            $table->string('documents_legaux_path')->nullable()->after('plan_financier_path');
            $table->string('autres_activites_path')->nullable()->after('documents_legaux_path');
        });
    }

    public function down(): void
    {
        Schema::table('candidatures', function (Blueprint $table) {
            $table->dropColumn(['business_plan_path', 'plan_financier_path', 'documents_legaux_path', 'autres_activites_path']);
        });
    }
};
