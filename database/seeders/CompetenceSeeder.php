<?php
/*@author lebel */
namespace Database\Seeders;
use App\Models\Competence;
use App\Models\Programme;
use Illuminate\Database\Seeder;

class CompetenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Programme à ajouter à la competence
        $programme1 = Programme::all()->where('code', '=', '420.B0')->first();

        //Créer des competences de base avec de vrai donnees representatives //
        $comp0000 = Competence::factory()->createOne([
            'code' => "0000",
            'enonce' => "Traiter l’information relative aux réalités du milieu du travail en informatique",
            'annee_devis' => 2018,
            'pages_devis' => '23',
            'contexte' => "À l’aide de documentation et d’outils de recherche",
        ]);
        $comp0000->associer_programme($programme1->id);



        $comp00Q1 = Competence::factory()->createOne([
            'code' => "00Q1",
            'enonce' => "Effectuer l’installation et la gestion d’ordinateurs",
            'annee_devis' => 2018,
            'pages_devis' => '25',
            'contexte' => "Pour différents systèmes d’exploitation. À partir d’une demande. À l’aide d’ordinateurs,
            de périphériques, de composants internes amovibles, etc. À l’aide de la documentation technique.
            À l’aide de systèmes d’exploitation, d’applications, d’utilitaires, de pilotes, de modules d’extension, etc.",
        ]);
        $comp00Q1->associer_programme($programme1->id);


        $comp00Q2 = Competence::factory()->createOne([
            'code' => "00Q2",
            'enonce' => "Utiliser des langages de programmation",
            'annee_devis' => 2018,
            'pages_devis' => '27',
            'contexte' => "Pour des problèmes dont la solution est simple. À l’aide d’algorithmes de base.
                            À l’aide d’un débogueur et d’un plan de tests fonctionnels.",
        ]);
        $comp00Q2->associer_programme($programme1->id);


        $comp00Q3 = Competence::factory()->createOne([
            'code' => "00Q3",
            'enonce' => "Résoudre des problèmes d’informatique avec les mathématiques",
            'annee_devis' => 2018,
            'pages_devis' => '29',
            'contexte' => "À partir de situations problèmes. À l’aide de données quantitatives.",
        ]);
        $comp00Q3->associer_programme($programme1->id);


        $comp00Q4 = Competence::factory()->createOne([
            'code' => "00Q4",
            'enonce' => "Exploiter des logiciels de bureautique",
            'annee_devis' => 2018,
            'pages_devis' => '31',
            'contexte' => "À l’aide de logiciels de traitement de texte, de tableurs ainsi que de logiciels de dessin,
             de présentation et de travail collaboratif. À l’aide d’images, de sons et de vidéos. À l’aide de normes de
              présentation.",
        ]);
        $comp00Q4->associer_programme($programme1->id);

        $comp00Q5 = Competence::factory()->createOne([
            'code' => "00Q5",
            'enonce' => "Effectuer le déploiement d’un réseau informatique local",
            'annee_devis' => 2018,
            'pages_devis' => '33',
            'contexte' => "Pour des réseaux informatiques locaux filaires et sans fil. À partir d’une demande.
             À l’aide d’ordinateurs, de dispositifs d’interconnexion et de câblage.
             À l’aide de la documentation technique",
        ]);
        $comp00Q5->associer_programme($programme1->id);


    }
}
