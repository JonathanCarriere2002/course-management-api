<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Migration prise du projet final PHP de Jacob H23
     * @author Jacob Beauregard-Tousignant
     */
    public function up(): void
    {
        Schema::create('plan_cadre_plan_cadre', function (Blueprint $table) {
            $table->foreignId("id_plan_cadre1");
            $table->foreignId("id_plan_cadre2");
            $table->string("typeRelation");
            $table->timestamps();


            $table->foreign("id_plan_cadre1")->references("id")->on("plans_cadres")->cascadeOnDelete();
            $table->foreign("id_plan_cadre2")->references("id")->on("plans_cadres")->cascadeOnDelete();
            $table->primary(['id_plan_cadre1', 'id_plan_cadre2']);
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
