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
        Schema::create('gabarit_section', function (Blueprint $table) {
            $table->foreignId('gabarit_id');
            $table->foreignId('section_id');
            $table->integer('ordre');
            $table->timestamps();
            $table->primary(['gabarit_id', 'section_id']);
            $table->foreign('gabarit_id')->references('id')->on('gabarits')->cascadeOnDelete();
            $table->foreign('section_id')->references('id')->on('sections')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gabarit_section');
    }
};
