<?php

/**
 * @author Emeric Chauret
 */

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
        // Créer la table pour les enseignants et programmes
        Schema::create('programme_user', function (Blueprint $table) {
            $table->primary(['programme_id', 'user_id']);
            $table->foreignId('programme_id');
            $table->foreignId('user_id');
            $table->foreign('programme_id')->references('id')->on('programmes')->cascadeOnDelete();
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programme_user');
    }
};
