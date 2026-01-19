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
        Schema::create('plan_cours_section', function (Blueprint $table) {
            $table->foreignId('plan_cours_id');
            $table->foreignId('section_id');
            $table->text('texte')->nullable();
            $table->timestamps();
            $table->primary(['plan_cours_id', 'section_id']);
            $table->foreign('plan_cours_id')->references('id')->on('plan_cours')->cascadeOnDelete();
            $table->foreign('section_id')->references('id')->on('sections')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plan_cours_section');
    }
};
