<?php
/* @author lebel */
namespace Database\Factories;

use App\Models\ElementCompetence;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CriterePerformance>
 */
class CriterePerformanceFactory extends Factory
{
    // Gerer le bond de 0.1 du numero
    protected $number = 0;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $this->number += 0.1;
        return [
            'numero' => null,
            'texte' => fake()->text(20),
            'isExpanded' => fake()->boolean(0),
            'element_competence_id' => null,
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
