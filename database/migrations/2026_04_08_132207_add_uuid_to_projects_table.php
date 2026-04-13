<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->uuid('uuid')->after('id')->nullable();
        });

        // Peupler les projets existants
        DB::table('projects')->whereNull('uuid')->orderBy('id')->each(function ($project) {
            DB::table('projects')
                ->where('id', $project->id)
                ->update(['uuid' => (string) Str::uuid()]);
        });

        Schema::table('projects', function (Blueprint $table) {
            $table->uuid('uuid')->nullable(false)->unique()->change();
        });
    }

    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn('uuid');
        });
    }
};