<?php

/**
 * @author Emeric Chauret
 */

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EnseignantPlanCoursSeeder extends Seeder
{
    /**
     * Méthode qui crée des relations entre enseignant et plan de cours avec des données réelles dans la bd.
     * @return void
     */
    public function run(): void
    {
        DB::table('enseignant_plan_cours')->insert([
            [
                'enseignant_id' => 1,
                'plan_cours_id' => 1,
                'groupe' => 1,
                'Dispo' => 'Lundi de 9h à 10h'
            ],
            [
                'enseignant_id' => 2,
                'plan_cours_id' => 1,
                'groupe' => 2,
                'Dispo' => 'Mercredi de 12h à 13h'
            ],
            [
                'enseignant_id' => 3,
                'plan_cours_id' => 2,
                'groupe' => 1,
                'Dispo' => 'Mardi de 12h à 13h'
            ],
            [
                'enseignant_id' => 4,
                'plan_cours_id' => 3,
                'groupe' => 1,
                'Dispo' => 'Lundi de 9h à 10h'
            ]
        ]);
    }
}
