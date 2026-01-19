<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration permettant de créer la table représentant la relation entre les enseignants et les programmes
 * @author Jonathan Carrière
 */
return new class extends Migration
{
    /**
     * Migration permettant de créer la table pour les enseignants et programmes
     */
    public function up(): void
    {
        // Créer la table pour les enseignants et programmes
        Schema::create('enseignant_programme', function (Blueprint $table) {
            $table->primary(['enseignant_id', 'programme_id']);
            $table->foreignId('enseignant_id')->nullable();
            $table->foreignId('programme_id')->nullable();
            $table->foreign("enseignant_id")->references("id")->on("enseignants")->cascadeOnDelete();
            $table->foreign("programme_id")->references("id")->on("programmes")->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Migration permettant de supprimer la table pour les enseignants et programmes
     */
    public function down(): void
    {
        // Supprimer la table pour les enseignants et programmes
        Schema::dropIfExists('enseignant_programme');
    }
};
