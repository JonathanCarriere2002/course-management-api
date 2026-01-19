<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration permettant de créer la table représentant la relation entre les éléments de compétences et les semaines de cours
 * @author Jonathan Carrière
 */
return new class extends Migration
{
    /**
     * Migration permettant de créer la table pour les éléments de compétences et semaines de cours
     */
    public function up(): void
    {
        // Créer la table pour les éléments de compétences et semaines de cours
        Schema::create('element_competence_semaine_cours', function (Blueprint $table) {
            $table->primary(['element_competence_id', 'semaine_cours_id']);
            $table->foreignId('element_competence_id')->nullable();
            $table->foreignId('semaine_cours_id')->nullable();
            $table->foreign("element_competence_id")->references("id")->on("elements_competence")->cascadeOnDelete();
            $table->foreign("semaine_cours_id")->references("id")->on("semaine_cours")->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Migration permettant de supprimer la table pour les éléments de compétences et semaines de cours
     */
    public function down(): void
    {
        // Supprimer la table pour les éléments de compétences et semaines de cours
        Schema::dropIfExists('element_competence_semaine_cours');
    }

};
