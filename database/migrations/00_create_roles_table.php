<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration permettant de créer la table représentant les rôles
 * @author Jonathan Carrière
 */
return new class extends Migration
{
    /**
     * Migration permettant de créer la table pour les rôles
     */
    public function up(): void
    {
        // Créer la table pour les rôles
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('nom', '100');
            $table->timestamps();
        });
    }

    /**
     * Migration permettant de supprimer la table pour les rôles
     */
    public function down(): void
    {
        // Supprimer la table pour les rôles
        Schema::dropIfExists('roles');
    }
};
