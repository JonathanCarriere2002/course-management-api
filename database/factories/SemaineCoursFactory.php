<?php

namespace Database\Factories;

use App\Models\PlanCadre;
use App\Models\PlanCours;
use App\Models\SemaineCours;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Factory permettant de créer des données initiales pour les semaines de cours
 * @extends Factory<SemaineCours> Factory pour des objets de type 'semaines de cours'
 * @author Jonathan Carrière
 */
class SemaineCoursFactory extends Factory
{
    /**
     * Méthode permettant de créer des données initiales pour les semaines de cours
     * @return array Array contenant les semaines de cours initiales
     */
    public function definition(): array
    {
        return [
            'semaineDebut' => fake()->numberBetween(1, 15),
            'semaineFin' => fake()->numberBetween(1, 15),
            'activites' => fake()->paragraph('3'),
            'contenu' => fake()->paragraph('3')
            //'plan_cours_id' => PlanCours::factory(1)->createOne()->id
        ];
    }
}
