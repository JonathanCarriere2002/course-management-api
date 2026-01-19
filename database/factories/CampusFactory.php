<?php

/**
 * @author Emeric Chauret
 */

namespace Database\Factories;

use App\Models\Campus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Campus>
 */
class CampusFactory extends Factory
{
    /**
     * Méthode qui permet de générer des données aléatoires
     * pour un objet campus.
     * @return array un tableau avec des données aléatoires pour un objet campus (array)
     */
    public function definition(): array
    {
        return [
            'nom' => fake()->name()
        ];
    }
}
