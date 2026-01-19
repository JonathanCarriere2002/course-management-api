<?php
/* @author lebel */
namespace Database\Factories;

use App\Models\Competence;
use App\Models\Programme;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Competence>
 */
class CompetenceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => fake()->regexify('Arrête'),
            'enonce' => 'Arrête d\'utiliser les factories de compétence',
            'annee_devis' => fake()->numberBetween(1960, 2023),
            'pages_devis' => fake()->regexify("^\d\d-\d\d$"),
            'contexte' => fake()->text(70),
            'programme_id' => Programme::all()->first(),
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
