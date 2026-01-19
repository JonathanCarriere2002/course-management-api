<?php

/**
 * @author Emeric Chauret
 */

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeSectionSeeder extends Seeder
{
    /**
     * Méthode qui crée des type de section avec des données réelles dans la bd.
     * @return void
     */
    public function run(): void
    {
        DB::table('type_sections')->insert([
            [
                'id' => 1,
                'type' => 'Texte riche'
            ],
            [
                'id' => 2,
                'type' => 'Calendrier des activités'
            ],
            [
                'id' => 3,
                'type' => 'Tableau des compétences'
            ]
        ]);
    }
}
