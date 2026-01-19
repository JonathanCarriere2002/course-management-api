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
        Schema::create('plan_cours', function (Blueprint $table) {
            $table->id();
            $table->foreignId('gabarit_id')->nullable();
            $table->foreignId('plan_cadre_id')->nullable();
            $table->foreignId('campus_id')->nullable();
            $table->foreignId('session_id')->nullable();
            $table->date('approbation')->nullable();
            $table->boolean('complet')->default(false);
            $table->foreignId('cree_par')->nullable();
            $table->timestamps();
            $table->foreign('gabarit_id')->references('id')->on('gabarits')->nullOnDelete();
            $table->foreign('plan_cadre_id')->references('id')->on('plans_cadres')->nullOnDelete();
            $table->foreign('campus_id')->references('id')->on('campuses')->nullOnDelete();
            $table->foreign('session_id')->references('id')->on('sessions')->nullOnDelete();
            $table->foreign('cree_par')->references('id')->on('users')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plan_cours');
    }
};
