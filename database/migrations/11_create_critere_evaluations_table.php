<?php

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
        Schema::create('criteres_evaluation', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("enonce");
            $table->integer("ponderation");
            $table->foreignId("plan_cadre_id")->nullable();

            $table->foreign("plan_cadre_id")->references("id")->on("plans_cadres")->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('critere_evaluations');
    }
};
