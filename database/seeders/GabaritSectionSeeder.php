<?php

/**
 * @author Emeric Chauret
 */

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GabaritSectionSeeder extends Seeder
{
    /**
     * Méthode qui crée des relations entre gabarit et section avec des données réelles dans la bd.
     * @return void
     */
    public function run(): void
    {
        DB::table('gabarit_section')->insert([
            [
                'gabarit_id' => 1,
                'section_id' => 1,
                'ordre' => 1
            ],
            [
                'gabarit_id' => 1,
                'section_id' => 9,
                'ordre' => 2
            ],
            [
                'gabarit_id' => 1,
                'section_id' => 2,
                'ordre' => 3
            ],
            [
                'gabarit_id' => 1,
                'section_id' => 3,
                'ordre' => 4
            ],
            [
                'gabarit_id' => 1,
                'section_id' => 8,
                'ordre' => 5
            ],
            [
                'gabarit_id' => 1,
                'section_id' => 4,
                'ordre' => 6
            ],
            [
                'gabarit_id' => 1,
                'section_id' => 5,
                'ordre' => 7
            ],
            [
                'gabarit_id' => 1,
                'section_id' => 6,
                'ordre' => 8
            ],
            [
                'gabarit_id' => 1,
                'section_id' => 7,
                'ordre' => 9
            ],


            /**
             * Sections du gabarit des plans-cadres
             */
            [
                'gabarit_id' => 2,
                'section_id' => 9,
                'ordre' => 1
            ],
            [
                'gabarit_id' => 2,
                'section_id' => 10,
                'ordre' => 2
            ],
            [
                'gabarit_id' => 2,
                'section_id' => 11,
                'ordre' => 3
            ],
            [
                'gabarit_id' => 2,
                'section_id' => 12,
                'ordre' => 3
            ],
            [
                'gabarit_id' => 2,
                'section_id' => 13,
                'ordre' => 4
            ],
        ]);
    }
}
