<?php

/**
 * @author Emeric Chauret
 */

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CampusSeeder extends Seeder
{
    /**
     * Méthode qui crée des campus avec des données réelles dans la bd.
     * @return void
     */
    public function run(): void
    {
        DB::table('campuses')->insert([
            [
                'id' => 1,
                'nom' => 'Gabrielle-Roy'
            ],
            [
                'id' => 2,
                'nom' => 'Félix Leclerc'
            ]
        ]);
    }
}
