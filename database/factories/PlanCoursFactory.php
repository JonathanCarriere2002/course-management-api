<?php

/**
 * @author Emeric Chauret
 */

namespace Database\Factories;

use App\Models\Campus;
use App\Models\Gabarit;
use App\Models\PlanCadre;
use App\Models\PlanCours;
use App\Models\Session;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<PlanCours>
 */
class PlanCoursFactory extends Factory
{
    /**
     * Méthode qui permet de générer des données aléatoires
     * pour un objet plan de cours.
     * @return array un tableau avec des données aléatoires pour un objet plan de cours (array)
     */
    public function definition(): array
    {
        return [
            'gabarit_id' => Gabarit::factory()->createOne()->id,
            'plan_cadre_id' => PlanCadre::factory()->createOne()->id,
            'campus_id' => Campus::factory()->createOne()->id,
            'session_id' => Session::factory()->createOne()->id,
            'approbation' => fake()->date(),
        ];
    }
}
