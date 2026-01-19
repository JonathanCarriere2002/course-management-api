<?php

namespace Database\Seeders;

use App\Models\Competence;
use App\Models\ElementCompetence;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ElementCompetenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Element de competence de la Competence 0000 //
        $competence0000 = Competence::all()->where('code', '=', '0000')->first();

        $elementComp00001 = ElementCompetence::factory()->createOne([
            'id' => 101,
            'numero' => "1.",
            'texte' => "Rechercher de l’information sur les professions et les milieux de travail en informatique.",
            'isExpanded' => false
        ]);
        $elementComp00001->associer_competence($competence0000->id);


        $elementComp00002 = ElementCompetence::factory()->createOne([
            'numero' => "2.",
            'texte' => "Analyser l’information sur les entreprises et les établissements embauchant des techniciennes
             et techniciens en informatique.",
            'isExpanded' => false
        ]);
        $elementComp00002->associer_competence($competence0000->id);


        $elementComp00003 = ElementCompetence::factory()->createOne([
            'numero' => "3.",
            'texte' => "Analyser l’information sur la profession de technicienne et technicien en informatique.",
            'isExpanded' => false
        ]);
        $elementComp00003->associer_competence($competence0000->id);


        // Element de competence de la Competence 00Q1 //

        $competence00Q1 = Competence::all()->where('code', '=', '00Q1')->first();

        $elementComp00Q11 = ElementCompetence::factory()->createOne([
            'numero' => "1.",
            'texte' => "Préparer l’ordinateur.",
            'competence_id' => $competence00Q1->id,
            'isExpanded' => false
        ]);
        $elementComp00Q11->associer_competence($competence00Q1);

        $elementComp00Q12 = ElementCompetence::factory()->createOne([
            'numero' => "2.",
            'texte' => "Installer le système d’exploitation.",
            'competence_id' => $competence00Q1->id,
            'isExpanded' => false
        ]);
        $elementComp00Q12->associer_competence($competence00Q1);

        $elementComp00Q13 = ElementCompetence::factory()->createOne([
            'numero' => "3.",
            'texte' => "Installer des applications.",
            'competence_id' => $competence00Q1->id,
            'isExpanded' => false
        ]);
        $elementComp00Q13->associer_competence($competence00Q1);

        $elementComp00Q14 = ElementCompetence::factory()->createOne([
            'numero' => "4.",
            'texte' => "Effectuer des tâches de gestion du système d’exploitation.",
            'competence_id' => $competence00Q1->id,
            'isExpanded' => false
        ]);
        $elementComp00Q14->associer_competence($competence00Q1);


        // Element de competence de la Competence 00Q2 //

        $competence00Q2 = Competence::all()->where('code', '=', '00Q2')->first();

        $elementComp00Q21 = ElementCompetence::factory()->createOne([
            'numero' => "1.",
            'texte' => "Analyser le problème.",
            'competence_id' => $competence00Q2->id,
            'isExpanded' => false
        ]);
        $elementComp00Q21->associer_competence($competence00Q2);

        $elementComp00Q22 = ElementCompetence::factory()->createOne([
            'numero' => "2.",
            'texte' => "Traduire l’algorithme dans le langage de programmation.",
            'competence_id' => $competence00Q2->id,
            'isExpanded' => false
        ]);
        $elementComp00Q22->associer_competence($competence00Q2);

        $elementComp00Q23 = ElementCompetence::factory()->createOne([
            'numero' => "3.",
            'texte' => "Déboguer le code.",
            'competence_id' => $competence00Q2->id,
            'isExpanded' => false
        ]);
        $elementComp00Q23->associer_competence($competence00Q2);

        $elementComp00Q24 = ElementCompetence::factory()->createOne([
            'numero' => "4.",
            'texte' => "Appliquer le plan de tests fonctionnels.",
            'competence_id' => $competence00Q2->id,
            'isExpanded' => false
        ]);
        $elementComp00Q24->associer_competence($competence00Q2);


        // Element de competence de la Competence 00Q3 //

        $competence00Q3 = Competence::all()->where('code', '=', '00Q3')->first();

        $elementComp00Q31 = ElementCompetence::factory()->createOne([
            'numero' => "1.",
            'texte' => "Traiter des nombres à représenter dans la mémoire d’un ordinateur.",
            'competence_id' => $competence00Q3->id,
            'isExpanded' => false
        ]);
        $elementComp00Q31->associer_competence($competence00Q3);

        $elementComp00Q32 = ElementCompetence::factory()->createOne([
            'numero' => "2.",
            'texte' => "Représenter des figures géométriques en deux dimensions sous la forme d’images numériques.",
            'competence_id' => $competence00Q3->id,
            'isExpanded' => false
        ]);
        $elementComp00Q32->associer_competence($competence00Q3);

        $elementComp00Q33 = ElementCompetence::factory()->createOne([
            'numero' => "3.",
            'texte' => "Modéliser des raisonnements logiques à plusieurs variables.",
            'competence_id' => $competence00Q3->id,
            'isExpanded' => false
        ]);
        $elementComp00Q33->associer_competence($competence00Q3);

        $elementComp00Q34 = ElementCompetence::factory()->createOne([
            'numero' => "4.",
            'texte' => "Traiter des données quantitatives par les statistiques descriptives.",
            'competence_id' => $competence00Q3->id,
            'isExpanded' => false
        ]);
        $elementComp00Q34->associer_competence($competence00Q3);


        // Element de competence de la Competence 00Q4 //

        $competence00Q4 = Competence::all()->where('code', '=', '00Q4')->first();

        $elementComp00Q41 = ElementCompetence::factory()->createOne([
            'numero' => "1.",
            'texte' => "Produire des rapports.",
            'competence_id' => $competence00Q4->id,
            'isExpanded' => false
        ]);
        $elementComp00Q41->associer_competence($competence00Q4);

        $elementComp00Q42 = ElementCompetence::factory()->createOne([
            'numero' => "2.",
            'texte' => "Produire des tableaux et des graphiques.",
            'competence_id' => $competence00Q4->id,
            'isExpanded' => false
        ]);
        $elementComp00Q42->associer_competence($competence00Q4);

        $elementComp00Q43 = ElementCompetence::factory()->createOne([
            'numero' => "3.",
            'texte' => "Produire des diagrammes ou des plans.",
            'competence_id' => $competence00Q4->id,
            'isExpanded' => false
        ]);
        $elementComp00Q43->associer_competence($competence00Q4);

        $elementComp00Q44 = ElementCompetence::factory()->createOne([
            'numero' => "4.",
            'texte' => "Produire des documents de présentation.",
            'competence_id' => $competence00Q4->id,
            'isExpanded' => false
        ]);
        $elementComp00Q44->associer_competence($competence00Q4);

        $elementComp00Q45 = ElementCompetence::factory()->createOne([
            'numero' => "5.",
            'texte' => "Partager et synchroniser des documents.",
            'competence_id' => $competence00Q4->id,
            'isExpanded' => false
        ]);
        $elementComp00Q45->associer_competence($competence00Q4);


        // Element de competence de la Competence 00Q5 //

        $competence00Q5 = Competence::all()->where('code', '=', '00Q5')->first();

        $elementComp00Q51 = ElementCompetence::factory()->createOne([
            'numero' => "1.",
            'texte' => "Définir les caractéristiques du réseau informatique local.",
            'competence_id' => $competence00Q5->id,
            'isExpanded' => false
        ]);
        $elementComp00Q51->associer_competence($competence00Q5);

        $elementComp00Q52 = ElementCompetence::factory()->createOne([
            'numero' => "2.",
            'texte' => "Installer les dispositifs d’interconnexion du réseau local.",
            'competence_id' => $competence00Q5->id,
            'isExpanded' => false
        ]);
        $elementComp00Q52->associer_competence($competence00Q5);

        $elementComp00Q53 = ElementCompetence::factory()->createOne([
            'numero' => "3.",
            'texte' => "Connecter les ordinateurs au réseau local.",
            'competence_id' => $competence00Q5->id,
            'isExpanded' => false
        ]);
        $elementComp00Q53->associer_competence($competence00Q5);

        $elementComp00Q54 = ElementCompetence::factory()->createOne([
            'numero' => "4.",
            'texte' => "Installer des services de partage de ressources.",
            'competence_id' => $competence00Q5->id,
            'isExpanded' => false
        ]);
        $elementComp00Q54->associer_competence($competence00Q5);

        $elementComp00Q55 = ElementCompetence::factory()->createOne([
            'numero' => "5.",
            'texte' => "Mettre en service le réseau local.",
            'competence_id' => $competence00Q5->id,
            'isExpanded' => false
        ]);
        $elementComp00Q55->associer_competence($competence00Q5);
    }
}
