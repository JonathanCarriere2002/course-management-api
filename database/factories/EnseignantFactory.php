<?php

namespace Database\Factories;

use App\Models\Enseignant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Factory permettant de créer des données initiales pour les enseignants
 * @extends Factory<Enseignant> Factory pour des objets de type 'enseignants'
 * @author Jonathan Carrière
 */
class EnseignantFactory extends Factory
{
    /**
     * Méthode permettant de créer des données initiales pour les enseignants
     * @return array Array contenant les enseignants initiaux
     */
    public function definition(): array
    {
        return [
            'nom' => fake()->unique()->lastName,
            'prenom' => fake()->unique()->firstName,
            'courriel' => fake()->randomElement(['john@email.qc.ca', 'david@email.qc.ca', 'jack@email.qc.ca']),
            'bureau' => fake()->randomElement(['1.063', '1.075', '1.085', '1.105', '2.708']),
            // 'poste' => fake()->randomElement([2000, 2005, 2010, 2015, 2020]),
            'created_at'=>now(),
            'updated_at'=>now()
        ];
    }

}
