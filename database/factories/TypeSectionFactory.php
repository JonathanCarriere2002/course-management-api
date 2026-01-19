<?php

/**
 * @author Emeric Chauret
 */

namespace Database\Factories;

use App\Models\TypeSection;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<TypeSection>
 */
class TypeSectionFactory extends Factory
{
    /**
     * Méthode qui permet de générer des données aléatoires
     * pour un objet type section.
     * @return array un tableau avec des données aléatoires pour un objet type section (array)
     */
    public function definition(): array
    {
        return [
            'type' => fake()->title()
        ];
    }
}
