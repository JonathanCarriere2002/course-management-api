<?php

/**
 * @author Emeric Chauret
 */

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlanCoursSeeder extends Seeder
{
    /**
     * Méthode qui crée des plans de cours avec des données réelles dans la bd.
     * @return void
     */
    public function run(): void
    {
        DB::table('plan_cours')->insert([
            [
                'id' => 1,
                'gabarit_id' => 1,
                'plan_cadre_id' => 1,
                'campus_id' => 1,
                'session_id' => 1,
                'approbation' => null,
                'complet' => true,
                'cree_par' => 5
            ],
            [
                'id' => 2,
                'gabarit_id' => 1,
                'plan_cadre_id' => 2,
                'campus_id' => 1,
                'session_id' => 4,
                'approbation' => null,
                'complet' => true,
                'cree_par' => 5
            ],
            [
                'id' => 3,
                'gabarit_id' => 1,
                'plan_cadre_id' => 3,
                'campus_id' => 1,
                'session_id' => 6,
                'approbation' => null,
                'complet' => true,
                'cree_par' => 5
            ]
        ]);
    }
}
