<?php

namespace Database\Seeders;

use App\Models\Enseignant;
use App\Models\Programme;
use Illuminate\Database\Seeder;

/**
 * Seeder permettant d'insérer des données initiales pour les enseignants dans la base de données
 * @author Jonathan Carrière
 */
class EnseignantSeeder extends Seeder
{
    /**
     * Insérer les objets dans la base de données
     */
    public function run(): void
    {
        // Liste contenant l'ensemble des programmes dans la base de données
        $programmes = Programme::all();

        // Insérer un enseignant et associer ses programmes
        $beauregard = Enseignant::factory()->createOne([
            "nom" => "Beauregard-Tousignant",
            "prenom" => "Jacob",
            "courriel" => "beauregard@cegepoutaouais.qc.ca",
            "bureau" => "1.063"
        ]);
        $beauregard->associerProgrammesSeeder([$programmes[0]->id, $programmes[30]->id]);

        // Insérer un enseignant et associer ses programmes
        $bolduc = Enseignant::factory()->createOne([
            "nom" => "Nom01",
            "prenom" => "Prénom01",
            "courriel" => "enseignant01@cegepoutaouais.qc.ca",
            "bureau" => "1.079"
        ]);
        $bolduc->associerProgrammesSeeder([$programmes[0]->id]);

        // Insérer un enseignant et associer ses programmes
        $bouallouche = Enseignant::factory()->createOne([
            "nom" => "Nom02",
            "prenom" => "Prénom02",
            "courriel" => "enseignant02@cegepoutaouais.qc.ca",
            "bureau" => "1.075",
            "poste" => 2013
        ]);
        $bouallouche->associerProgrammesSeeder([$programmes[0]->id, $programmes[1]->id, $programmes[30]->id]);

        // Insérer un enseignant et associer ses programmes
        $bouguerra= Enseignant::factory()->createOne([
            "nom" => "Nom03",
            "prenom" => "Prénom03",
            "courriel" => "enseignant03@cegepoutaouais.qc.ca",
            "bureau" => "1.065",
            "poste" => 2021
        ]);
        $bouguerra->associerProgrammesSeeder([$programmes[0]->id, $programmes[30]->id]);

        // Insérer un enseignant et associer ses programmes
        $bounouar = Enseignant::factory()->createOne([
            "nom" => "Nom04",
            "prenom" => "Prénom04",
            "courriel" => "enseignant04@cegepoutaouais.qc.ca",
            "bureau" => "1.067",
            "poste" => 2014
        ]);
        $bounouar->associerProgrammesSeeder([$programmes[0]->id]);

        // Insérer un enseignant et associer ses programmes
        $corriveau = Enseignant::factory()->createOne([
            "nom" => "Nom05",
            "prenom" => "Prénom05",
            "courriel" => "enseignant05@cegepoutaouais.qc.ca",
            "bureau" => "1.077",
            "poste" => 2022
        ]);
        $corriveau->associerProgrammesSeeder([$programmes[0]->id, $programmes[1]->id, $programmes[30]->id]);

        // Insérer un enseignant et associer ses programmes
        $elouasbi = Enseignant::factory()->createOne([
            "nom" => "Nom06",
            "prenom" => "Prénom06",
            "courriel" => "enseignant06@cegepoutaouais.qc.ca",
            "bureau" => "1.075"
        ]);
        $elouasbi->associerProgrammesSeeder([$programmes[0]->id, $programmes[30]->id]);

        // Insérer un enseignant et associer ses programmes
        $gauthier = Enseignant::factory()->createOne([
            "nom" => "Nom07",
            "prenom" => "Prénom07",
            "courriel" => "enseignant07@cegepoutaouais.qc.ca",
            "bureau" => "1.071",
            "poste" => 2024
        ]);
        $gauthier->associerProgrammesSeeder([$programmes[30]->id]);

        // Insérer un enseignant et associer ses programmes
        $hocini = Enseignant::factory()->createOne([
            "nom" => "Nom08",
            "prenom" => "Prénom08",
            "courriel" => "enseignant08@cegepoutaouais.qc.ca",
            "bureau" => "1.076",
            "poste" => 2015
        ]);
        $hocini->associerProgrammesSeeder([$programmes[0]->id, $programmes[30]->id]);

        // Insérer un enseignant et associer ses programmes
        $huneault = Enseignant::factory()->createOne([
            "nom" => "Nom09",
            "prenom" => "Prénom09",
            "courriel" => "enseignant09@cegepoutaouais.qc.ca",
            "bureau" => "1.077",
            "poste" => 2016
        ]);
        $huneault->associerProgrammesSeeder([$programmes[0]->id, $programmes[1]->id, $programmes[30]->id]);

        // Insérer un enseignant et associer ses programmes
        $levasseur = Enseignant::factory()->createOne([
            "nom" => "Nom10",
            "prenom" => "Prénom10",
            "courriel" => "enseignant10@cegepoutaouais.qc.ca",
            "bureau" => "1.075",
            "poste" => 2017
        ]);
        $levasseur->associerProgrammesSeeder([$programmes[0]->id, $programmes[30]->id]);;

        // Insérer un enseignant et associer ses programmes
        $mayrandstgelais = Enseignant::factory()->createOne([
            "nom" => "Nom11",
            "prenom" => "Prénom11",
            "courriel" => "enseignant11@cegepoutaouais.qc.ca",
            "bureau" => "1.050",
            "poste" => 2024
        ]);
        $mayrandstgelais->associerProgrammesSeeder([$programmes[0]->id]);

        // Insérer un enseignant et associer ses programmes
        $mongeau = Enseignant::factory()->createOne([
            "nom" => "Nom12",
            "prenom" => "Prénom12",
            "courriel" => "enseignant12@cegepoutaouais.qc.ca",
            "bureau" => "1.076",
            "poste" => 2018
        ]);
        $mongeau->associerProgrammesSeeder([$programmes[0]->id, $programmes[30]->id]);

        // Insérer un enseignant et associer ses programmes
        $page = Enseignant::factory()->createOne([
            "nom" => "Nom13",
            "prenom" => "Prénom13",
            "courriel" => "enseignant13@cegepoutaouais.qc.ca",
            "bureau" => "1.083",
            "poste" => 2019
        ]);
        $page->associerProgrammesSeeder([$programmes[0]->id, $programmes[1]->id, $programmes[30]->id]);

        // Insérer un enseignant et associer ses programmes
        $stgeorges = Enseignant::factory()->createOne([
            "nom" => "Nom14",
            "prenom" => "Prénom14",
            "courriel" => "enseignant14@cegepoutaouais.qc.ca",
            "bureau" => "1.081",
            "poste" => 2020
        ]);
        $stgeorges->associerProgrammesSeeder([$programmes[0]->id, $programmes[30]->id]);

        // Insérer un enseignant et associer ses programmes
        $stambouli = Enseignant::factory()->createOne([
            "nom" => "Nom15",
            "prenom" => "Prénom15",
            "courriel" => "enseignant15@cegepoutaouais.qc.ca",
            "bureau" => "1.050",
            "poste" => 2025
        ]);
        $stambouli->associerProgrammesSeeder([$programmes[0]->id]);

        // Insérer un enseignant et associer ses programmes
        $carriere = Enseignant::factory()->createOne([
            "nom" => "Carrière",
            "prenom" => "Jonathan",
            "courriel" => "carriere@cegepoutaouais.qc.ca",
            "bureau" => "1.063"
        ]);
        $carriere->associerProgrammesSeeder([$programmes[0]->id, $programmes[30]->id]);

        // Insérer un enseignant et associer ses programmes
        $chauret = Enseignant::factory()->createOne([
            "nom" => "Chauret",
            "prenom" => "Emeric",
            "courriel" => "chauret@cegepoutaouais.qc.ca",
            "bureau" => "1.063"
        ]);
        $chauret->associerProgrammesSeeder([$programmes[0]->id, $programmes[30]->id]);

        // Insérer un enseignant et associer ses programmes
        $elhaddaji = Enseignant::factory()->createOne([
            "nom" => "El Haddaji",
            "prenom" => "Samir",
            "courriel" => "elhaddaji@cegepoutaouais.qc.ca",
            "bureau" => "1.063"
        ]);
        $elhaddaji->associerProgrammesSeeder([$programmes[0]->id, $programmes[30]->id]);

        // Insérer un enseignant et associer ses programmes
        $lebel = Enseignant::factory()->createOne([
            "nom" => "Lebel",
            "prenom" => "Jérémy",
            "courriel" => "lebel@cegepoutaouais.qc.ca",
            "bureau" => "1.063"
        ]);
        $lebel->associerProgrammesSeeder([$programmes[0]->id, $programmes[30]->id]);

    }

}
