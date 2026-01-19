<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration permettant de créer la table représentant la relation entre les enseignants et les plans de cours
 * @author Jonathan Carrière
 */
return new class extends Migration
{
    /**
     * Migration permettant de créer la table pour les enseignants et plans de cours
     */
    public function up(): void
    {
        // Créer la table pour les enseignants et plans de cours
        Schema::create('enseignant_plan_cours', function (Blueprint $table) {
            $table->primary(['enseignant_id', 'plan_cours_id']);
            $table->foreignId('enseignant_id');
            $table->foreignId('plan_cours_id');
            $table->integer('groupe')->nullable();
            $table->string('dispo')->nullable();
            $table->foreign("enseignant_id")->references("id")->on("enseignants")->cascadeOnDelete();
            $table->foreign("plan_cours_id")->references("id")->on("plan_cours")->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Migration permettant de supprimer la table pour les enseignants et plans de cours
     */
    public function down(): void
    {
        // Supprimer la table pour les enseignants et plans de cours
        Schema::dropIfExists('enseignant_plan_cours');
    }

};
