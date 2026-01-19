<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration permettant de créer la table représentant les sessions
 * @author Jonathan Carrière
 */
return new class extends Migration
{
    /**
     * Migration permettant de créer la table pour les sessions
     */
    public function up(): void
    {
        // Créer la table pour les sessions
        Schema::create('sessions', function (Blueprint $table) {
            $table->id();
            $table->string('session', '50');
            $table->year('annee');
            $table->date('limite_abandon');
            $table->timestamps();
        });
    }

    /**
     * Migration permettant de supprimer la table pour les sessions
     */
    public function down(): void
    {
        // Supprimer la table pour les sessions
        Schema::dropIfExists('sessions');
    }

};
