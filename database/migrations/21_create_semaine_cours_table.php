<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration permettant de créer la table représentant les semaines de cours
 * @author Jonathan Carrière
 */
return new class extends Migration
{
    /**
     * Migration permettant de créer la table pour les semaines de cours
     */
    public function up(): void
    {
        // Créer la table pour les semaines de cours
        Schema::create('semaine_cours', function (Blueprint $table) {
            $table->id();
            $table->integer('semaineDebut');
            $table->integer('semaineFin');
            $table->text('activites')->nullable();
            $table->text('contenu')->nullable();
            $table->foreignId('plan_cours_id')->nullable();
            $table->foreign("plan_cours_id")->references("id")->on("plan_cours")->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Migration permettant de supprimer la table pour les semaines de cours
     */
    public function down(): void
    {
        // Supprimer la table pour les sessions
        Schema::dropIfExists('semaine_cours');
    }

};
