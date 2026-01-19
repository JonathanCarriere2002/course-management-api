<?php

namespace Database\Seeders;

use App\Models\Session;
use Illuminate\Database\Seeder;

/**
 * Seeder permettant d'insérer des données initiales pour les sessions dans la base de données
 * @author Jonathan Carrière
 */
class SessionSeeder extends Seeder
{
    /**
     * Insérer les objets dans la base de données
     */
    public function run(): void
    {
        // Insérer une session
        $sessionA23 = Session::factory()->createOne([
            "session" => "Automne",
            "annee" => 2023,
            "limite_abandon" => "2023-09-01"
        ]);

        // Insérer une session
        $sessionE23 = Session::factory()->createOne([
            "session" => "Été",
            "annee" => 2023,
            "limite_abandon" => "2023-06-01"
        ]);

        // Insérer une session
        $sessionH23 = Session::factory()->createOne([
            "session" => "Hiver",
            "annee" => 2023,
            "limite_abandon" => "2023-02-01"
        ]);

        // Insérer une session
        $sessionA22 = Session::factory()->createOne([
            "session" => "Automne",
            "annee" => 2022,
            "limite_abandon" => "2022-09-01"
        ]);

        // Insérer une session
        $sessionE22 = Session::factory()->createOne([
            "session" => "Été",
            "annee" => 2022,
            "limite_abandon" => "2022-06-01"
        ]);

        // Insérer une session
        $sessionH22 = Session::factory()->createOne([
            "session" => "Hiver",
            "annee" => 2022,
            "limite_abandon" => "2022-02-01"
        ]);

        // Insérer une session
        $sessionA21 = Session::factory()->createOne([
            "session" => "Automne",
            "annee" => 2021,
            "limite_abandon" => "2021-09-01"
        ]);

        // Insérer une session
        $sessionE21 = Session::factory()->createOne([
            "session" => "Été",
            "annee" => 2021,
            "limite_abandon" => "2021-06-01"
        ]);

        // Insérer une session
        $sessionH21 = Session::factory()->createOne([
            "session" => "Hiver",
            "annee" => 2021,
            "limite_abandon" => "2021-02-01"
        ]);

        // Insérer une session
        $sessionA20 = Session::factory()->createOne([
            "session" => "Automne",
            "annee" => 2020,
            "limite_abandon" => "2020-09-01"
        ]);

        // Insérer une session
        $sessionE20 = Session::factory()->createOne([
            "session" => "Été",
            "annee" => 2020,
            "limite_abandon" => "2020-06-01"
        ]);

        // Insérer une session
        $sessionH20 = Session::factory()->createOne([
            "session" => "Hiver",
            "annee" => 2020,
            "limite_abandon" => "2020-02-01"
        ]);

        // Insérer une session
        $sessionA19 = Session::factory()->createOne([
            "session" => "Automne",
            "annee" => 2019,
            "limite_abandon" => "2019-09-01"
        ]);

        // Insérer une session
        $sessionE19 = Session::factory()->createOne([
            "session" => "Été",
            "annee" => 2019,
            "limite_abandon" => "2019-06-01"
        ]);

        // Insérer une session
        $sessionH19 = Session::factory()->createOne([
            "session" => "Hiver",
            "annee" => 2019,
            "limite_abandon" => "2019-02-01"
        ]);

        // Insérer une session
        $sessionA18 = Session::factory()->createOne([
            "session" => "Automne",
            "annee" => 2018,
            "limite_abandon" => "2018-09-01"
        ]);
    }

}
