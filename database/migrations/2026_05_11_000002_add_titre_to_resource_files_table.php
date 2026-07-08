<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('resource_files', function (Blueprint $table) {
            $table->string('titre')->after('resource_item_id');
        });

        Schema::table('resources', function (Blueprint $table) {
            $table->string('file_titre')->nullable()->after('file_type');
        });
    }

    public function down(): void
    {
        Schema::table('resource_files', function (Blueprint $table) {
            $table->dropColumn('titre');
        });

        Schema::table('resources', function (Blueprint $table) {
            $table->dropColumn('file_titre');
        });
    }
};
