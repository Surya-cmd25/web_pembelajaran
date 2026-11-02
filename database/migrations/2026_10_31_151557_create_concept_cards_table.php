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
        Schema::create('concept_cards', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('front_text');
            $table->text('back_text');
            $table->string('icon')->default('document');
            $table->string('color')->default('blue');
            $table->unsignedTinyInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('concept_cards');
    }
};
