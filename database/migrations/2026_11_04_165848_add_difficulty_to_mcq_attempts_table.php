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
            $table->string('difficulty', 20)->nullable()->after('total');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mcq_attempts', function (Blueprint $table) {
            $table->dropColumn('difficulty');
        });
    }
};
