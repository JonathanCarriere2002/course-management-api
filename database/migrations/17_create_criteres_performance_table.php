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
        Schema::create('criteres_performance', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("numero")->nullable();
            $table->string("texte", 255);
            $table->boolean("isExpanded")->default(false);
            $table->foreignId("element_competence_id")->nullable();

            $table->foreign("element_competence_id")->references("id")->on("elements_competence")->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('criteres_performance');
    }
};
