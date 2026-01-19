<?php

/**
 * @author Jaocb Beauregard-Tousignant
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
        Schema::create('plans_cadres', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("code");
            $table->string("titre");
            $table->string("ponderation");
            $table->integer("unites")->nullable();
            $table->text("attitudes")->nullable();
            $table->boolean('complet')->default(false);

            $table->integer("ponderationFinale")->nullable();
            $table->date("changement")->nullable();
            $table->date("dateApprobationDepartement")->nullable();
            $table->date("dateApprobationComiteProgrammes")->nullable();
            $table->date("dateDepotDirectionEtudes")->nullable();
            $table->foreignId("session_id")->nullable();
            $table->foreignId("programme_id")->nullable();
            $table->foreignId("gabarit_id")->nullable();

            $table->foreign("session_id")->references("id")->on("sessions")->nullOnDelete();
            $table->foreign("programme_id")->references("id")->on("programmes")->nullOnDelete();
            $table->foreign('gabarit_id')->references('id')->on('gabarits')->nullOnDelete();

            //Remplacer certains champs par des sections


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plans_cadres');
    }
};
