<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration permettant de créer la table représentant les enseignants
 * @author Jonathan Carrière
 */
return new class extends Migration
{
    /**
     * Migration permettant de créer la table pour les enseignants
     */
    public function up(): void
    {
        // Créer la table pour les enseignants
        Schema::create('enseignants', function (Blueprint $table) {
            $table->id();
            $table->string('nom', '50');
            $table->string('prenom', '50');
            $table->string('courriel', '50');
            $table->string('bureau', '50');
            $table->integer('poste')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Migration permettant de supprimer la table pour les enseignants
     */
    public function down(): void
    {
        // Supprimer la table pour les enseignants
        Schema::dropIfExists('enseignants');
    }

};
