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
        Schema::create('puzzle_levels', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('level')->unique();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('image_path')->nullable();
            $table->unsignedTinyInteger('rows')->default(2);
            $table->unsignedTinyInteger('cols')->default(3);
            $table->unsignedSmallInteger('time_limit')->default(300);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::table('puzzle_progress', function (Blueprint $table) {
            $table->unsignedSmallInteger('best_seconds')->nullable()->after('is_completed');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('puzzle_progress', function (Blueprint $table) {
            $table->dropColumn('best_seconds');
        });

        Schema::dropIfExists('puzzle_levels');
    }
};
