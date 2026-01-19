<?php
/* @author lebel */
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
        Schema::create('competences', function (Blueprint $table){
            $table->id();
            $table->timestamps();
            $table->string('code', 255);
            $table->string('enonce', 500);
            $table->integer('annee_devis');
            $table->string('pages_devis', 255);
            $table->string('contexte', 1500);
            $table->foreignId('programme_id')->nullable();

            $table->foreign('programme_id')->references("id")->on("programmes")->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Supprimer la table de compétence
        Schema::dropIfExists('competences');
    }
};
