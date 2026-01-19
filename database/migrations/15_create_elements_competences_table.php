<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
/* @author lebel */
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('elements_competence', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("numero");
            $table->string("texte", 255);
            $table->boolean("isExpanded")->default(false);
            $table->foreignId('competence_id')->nullable();

            $table->foreign('competence_id')->references("id")->on("competences")->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Supprimer la table des éléments de compétence
        Schema::dropIfExists('elements_competence');
    }
};
