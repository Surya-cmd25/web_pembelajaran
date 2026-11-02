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
        Schema::table('mcq_attempts', function (Blueprint $table) {
            $table->unsignedSmallInteger('duration_seconds')->nullable()->after('answers');
            $table->json('review')->nullable()->after('duration_seconds');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mcq_attempts', function (Blueprint $table) {
            $table->dropColumn(['duration_seconds', 'review']);
        });
    }
};
