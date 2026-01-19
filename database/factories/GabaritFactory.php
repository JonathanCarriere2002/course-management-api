<?php

/**
 * @author Emeric Chauret
 */

namespace Database\Factories;

use App\Models\Gabarit;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Gabarit>
 */
class GabaritFactory extends Factory
{
    /**
     * Méthode qui permet de générer des données aléatoires
     * pour un objet gabarit.
     * @return array un tableau avec des données aléatoires pour un objet gabarit (array)
     */
    public function definition(): array
    {
        return [
            'nom' => 'Gabarit '.fake()->title()
        ];
    }
}
