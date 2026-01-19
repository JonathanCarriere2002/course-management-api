<?php

/**
 * @authors Emeric Chauret, Jacob Beauregard-Touignant
 */

namespace Database\Seeders;

use App\Models\Gabarit;
use App\Models\Section;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GabaritSeeder extends Seeder
{
    /**
     * Méthode qui crée des gabarits avec des données réelles dans la bd.
     * @return void
     */
    public function run(): void
    {
        DB::table('gabarits')->insert([
            [
                'id' => 1,
                'nom' => 'Gabarit plan de cours'
            ]
        ]);


        /**
         * @author Jacob Beauregard-Tousignant
         */

        Gabarit::factory()->createOne([
            'nom' => 'Gabarit plan-cadre'
        ]);



    }
}
