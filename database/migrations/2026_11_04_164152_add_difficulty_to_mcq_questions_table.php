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
        Schema::table('mcq_questions', function (Blueprint $table) {
            $table->string('difficulty', 20)->default('sedang')->after('question');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mcq_questions', function (Blueprint $table) {
            $table->dropColumn('difficulty');
        });
    }
};
