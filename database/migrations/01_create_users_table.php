<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration permettant de créer la table représentant les utilisateurs
 * @author Jonathan Carrière
 */
return new class extends Migration
{
    /**
     * Migration permettant de créer la table pour les utilisateurs
     */
    public function up(): void
    {
        // Créer la table pour les utilisateurs
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', '50');
            $table->string('firstname', '50');
            $table->string('email', '50')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->foreignId('role')->nullable();
            $table->foreign('role')->references('id')->on('roles')->cascadeOnDelete();
            $table->string('bureau')->nullable();
            $table->integer('poste')->nullable();
            $table->rememberToken()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Migration permettant de supprimer la table pour les utilisateurs
     */
    public function down(): void
    {
        // Supprimer la table pour les utilisateurs
        Schema::dropIfExists('users');
    }
};
