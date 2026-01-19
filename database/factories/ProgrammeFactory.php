<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Programme>
 */
class ProgrammeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "code" => fake()->regexify('^\d{3}\.[A-Z]\d$'),
            "titre"=>fake()->randomElement(["Sciences de la nature","Art, lettres et communication","Soins infirmiers","Programmation et sécurité"]),
            'created_at'=>now(),
            'updated_at'=>now()
        ];
    }
}
