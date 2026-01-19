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
        Schema::create('competences_plans_cadre', function (Blueprint $table) {
            $table->timestamps();
            $table->text("ContexteLocal");
            $table->text("Atteinte");
            $table->text("Completion")->nullable();
            $table->foreignId("competence_id");
            $table->foreignId("plan_cadre_id");

            $table->foreign("competence_id")->references("id")->on("competences")->cascadeOnDelete();
            $table->foreign("plan_cadre_id")->references("id")->on("plans_cadres")->cascadeOnDelete();
            $table->primary(["competence_id", "plan_cadre_id"]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('competences_plans_cadre');
    }
};
