<?php

/**
 * @authors Emeric Chauret, Jacob Beauregard-Tousignant
 */

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SectionSeeder extends Seeder
{
    /**
     * Méthode qui crée des sections avec des données réelles dans la bd.
     * @return void
     */
    public function run(): void
    {
        /**
         * @author Emeric Chauret
         */
        DB::table('sections')->insert([
            [
                'id' => 1,
                'titre' => 'INTRODUCTION',
                'aide' => '',
                'obligatoire' => true,
                'type_section_id' => 1
            ],
            [
                'id' => 2,
                'titre' => 'CONTENU DU COURS (RÉSUMÉ DES CONTENUS DU COURS)',
                'aide' => '',
                'obligatoire' => true,
                'type_section_id' => 1
            ],
            [
                'id' => 3,
                'titre' => 'MÉTHODES PÉDAGOGIQUES ET LES ACTIVITÉS D’APPRENTISSAGE',
                'aide' => '',
                'obligatoire' => true,
                'type_section_id' => 1
            ],
            [
                'id' => 4,
                'titre' => 'ÉVALUATION DES APPRENTISSAGES',
                'aide' => '',
                'obligatoire' => true,
                'type_section_id' => 1
            ],
            [
                'id' => 5,
                'titre' => 'MODALITÉS D’ENCADREMENT EN LIEN AVEC LE COURS',
                'aide' => '',
                'obligatoire' => true,
                'type_section_id' => 1
            ],
            [
                'id' => 6,
                'titre' => 'MATÉRIEL ET LOGICIELS REQUIS / FOURNI / DISPONIBLE / OPTIONNEL',
                'aide' => '',
                'obligatoire' => true,
                'type_section_id' => 1
            ],
            [
                'id' => 7,
                'titre' => 'MÉDIAGRAPHIE',
                'aide' => '',
                'obligatoire' => false,
                'type_section_id' => 1
            ],
            [
                'id' => 8,
                'titre' => 'CALENDRIER DES ACTIVITÉS',
                'aide' => '',
                'obligatoire' => true,
                'type_section_id' => 2
            ],
            [
                'id' => 9,
                'titre' => 'COMPÉTENCE(S) DE CE COURS',
                'aide' => '',
                'obligatoire' => true,
                'type_section_id' => 3
            ],

            /**
             * @author Jacob Beauregard-Tousignant
             */
            [
                'id' => 10,
                'titre' => 'INTENTIONS ÉDUCATIVES',
                'aide' => '',
                'obligatoire' => true,
                'type_section_id' => 1
            ],
            [
                'id' => 11,
                'titre' => 'INTENTIONS PÉDAGOGIQUES',
                'aide' => '',
                'obligatoire' => true,
                'type_section_id' => 1
            ],
            [
                'id' => 12,
                'titre' => 'DESCRIPTION DU COURS',
                'aide' => '',
                'obligatoire' => true,
                'type_section_id' => 1
            ],
            [
                'id' => 13,
                'titre' => 'ATTITUDES',
                'aide' => '',
                'obligatoire' => true,
                'type_section_id' => 1
            ],

        ]);

    }
}
