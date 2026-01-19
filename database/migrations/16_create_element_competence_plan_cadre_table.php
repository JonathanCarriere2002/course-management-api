<?php
/* @author jacob*/
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
        Schema::create('element_competence_plan_cadre', function (Blueprint $table) {
            $table->foreignId("id_plan_cadre");
            $table->foreignId("id_element_compe");
            $table->text("contenu_local");
            $table->timestamps();

            $table->foreign("id_plan_cadre")->references("id")->on("plans_cadres")->cascadeOnDelete();
            $table->foreign("id_element_compe")->references("id")->on("elements_competence")->cascadeOnDelete();
            $table->primary(["id_plan_cadre", "id_element_compe"]);
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
