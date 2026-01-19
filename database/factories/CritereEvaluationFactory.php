<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CritereEvaluation>
 */
class CritereEvaluationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'enonce' => fake()->text(100),
            'ponderation' => fake()->numberBetween(1, 100),
            'plan_cadre_id' => fake()->numberBetween(1, 3),
        ];
    }
}
