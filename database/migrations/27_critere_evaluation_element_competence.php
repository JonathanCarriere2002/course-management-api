<?php

/**
 * @author Jacob Beauregard-Tousignant + lebel
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * @author Jacob beauregard-Tousignant
     */
    public function up(): void
    {
        Schema::create('critere_evaluation_element_competence', function (Blueprint $table) {
            $table->foreignId("id_critere_eval");
            $table->foreignId("id_element_compe");
            $table->timestamps();


            $table->foreign("id_critere_eval")->references("id")->on("criteres_evaluation")->cascadeOnDelete();
            $table->foreign("id_element_compe")->references("id")->on("elements_competence")->cascadeOnDelete();
            $table->primary(["id_critere_eval", "id_element_compe"], "id");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
