<?php
/* @author lebel */
namespace Database\Factories;

use App\Models\Competence;
use App\Models\CriterePerformance;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ElementCompetence>
 */
class ElementCompetenceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'numero' => fake()->numberBetween(1, 10),
            'texte' => fake()->text(30),
            'competence_id' => null,
            'isExpanded' => fake()->boolean(0),
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
