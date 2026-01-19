<?php

/**
 * @author Emeric Chauret
 */

namespace Database\Factories;

use App\Models\Section;
use App\Models\TypeSection;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Section>
 */
class SectionFactory extends Factory
{
    /**
     * Méthode qui permet de générer des données aléatoires
     * pour un objet section.
     * @return array un tableau avec des données aléatoires pour un objet section (array)
     */
    public function definition(): array
    {
        return [
            'titre' => strtoupper(fake()->title()),
            'aide' => fake()->optional(0.5, '')->text(100),
            'obligatoire' => fake()->boolean(),
            'type_section_id' => TypeSection::factory()->createOne()->id
        ];
    }
}
