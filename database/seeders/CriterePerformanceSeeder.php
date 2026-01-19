<?php

namespace Database\Seeders;

use App\Models\CriterePerformance;
use App\Models\ElementCompetence;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CriterePerformanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Critere de la competence 0000 //
        $elementCompetence00001 = ElementCompetence::all()->where('texte', '=', 'Rechercher de l’information sur les professions et les milieux de travail en informatique.')->first();

        $critereComp000011 = CriterePerformance::factory()->createOne([
            'numero' => "",
            'texte' => "Choix approprié des sources d’information.",
            'isExpanded' => false
        ]);
        $critereComp000011->associer_element_competences($elementCompetence00001);

        $critereComp000012 = CriterePerformance::factory()->createOne([
            'numero' => "",
            'texte' => "Fiabilité et diversité de l’information recueillie.",
            'isExpanded' => false
        ]);
        $critereComp000012->associer_element_competences($elementCompetence00001);

        $critereComp000013 = CriterePerformance::factory()->createOne([
            'numero' => "",
            'texte' => "Utilisation appropriée des outils de recherche.",
            'isExpanded' => false
        ]);
        $critereComp000013->associer_element_competences($elementCompetence00001);

        $elementCompetence00002 = ElementCompetence::all()->where('texte', '=', 'Analyser l’information sur les entreprises et les établissements embauchant des techniciennes
             et techniciens en informatique.')->first();

        $critereComp000021 = CriterePerformance::factory()->createOne([
            'numero' => "",
            'texte' => "Distinction juste des principales caractéristiques des domaines du développement des
                        applications et de l’administration des réseaux informatiques.",
            'isExpanded' => false
        ]);
        $critereComp000021->associer_element_competences($elementCompetence00002);

        $critereComp000022 = CriterePerformance::factory()->createOne([
            'numero' => "",
            'texte' => "Distinction juste des caractéristiques des produits et des services offerts par les
                        entreprises et les établissements.",
            'isExpanded' => false
        ]);
        $critereComp000022->associer_element_competences($elementCompetence00002);

        $critereComp000023 = CriterePerformance::factory()->createOne([
            'numero' => "",
            'texte' => "Distinction juste des différentes professions.",
            'isExpanded' => false
        ]);
        $critereComp000023->associer_element_competences($elementCompetence00002);

        $critereComp000024 = CriterePerformance::factory()->createOne([
            'numero' => "",
            'texte' => "Reconnaissance adéquate des associations professionnelles et syndicales présentes.",
            'isExpanded' => false
        ]);
        $critereComp000024->associer_element_competences($elementCompetence00002);

        $critereComp000025 = CriterePerformance::factory()->createOne([
            'numero' => "",
            'texte' => "Reconnaissance adéquate des sources et des niveaux de risque pour la santé et la sécurité
                        au travail.",
            'isExpanded' => false
        ]);
        $critereComp000025->associer_element_competences($elementCompetence00002);


        $elementCompetence00003 = ElementCompetence::all()->where('texte', '=', 'Analyser
        l’information sur la profession de technicienne et technicien en informatique.')->first();

        $elementCompetence00003 = ElementCompetence::all()->where('texte', '=', 'Analyser l’information sur la profession de technicienne et technicien en informatique.')->first();

        $critereComp000031 = CriterePerformance::factory()->createOne([
            'numero' => "",
            'texte' => "Examen détaillé des tâches et des responsabilités liées à la profession.",
            'isExpanded' => false
        ]);
        $critereComp000031->associer_element_competences($elementCompetence00003);

        $critereComp000032 = CriterePerformance::factory()->createOne([
            'numero' => "",
            'texte' => "Distinction juste des connaissances, des comportements, des attitudes et des habiletés
             nécessaires à l’exercice de la profession.",
            'isExpanded' => false
        ]);
        $critereComp000032->associer_element_competences($elementCompetence00003);

        $critereComp000033 = CriterePerformance::factory()->createOne([
            'numero' => "",
            'texte' => "Distinction juste des limites d’intervention propres à la profession.",
            'isExpanded' => false
        ]);
        $critereComp000033->associer_element_competences($elementCompetence00003);



        // Critere de la competence 00Q1 //

        // TODO enlever la propriete element_competence_id et utiliser la methode d'association de critere perfo

        $elementCompetence00Q11 = ElementCompetence::all()->where('texte', '=', 'Préparer l’ordinateur.')->first();

        $critereComp00Q11 = CriterePerformance::factory()->createOne([
            'numero' => "",
            'texte' => "Interprétation juste de la demande.",
            'element_competence_id' => $elementCompetence00Q11->id,
            'isExpanded' => false
        ]);

        $critereComp00Q12 = CriterePerformance::factory()->createOne([
            'numero' => "",
            'texte' => "Interprétation juste des spécifications de l’équipement informatique.",
            'element_competence_id' => $elementCompetence00Q11->id,
            'isExpanded' => false
        ]);

        $critereComp00Q13 = CriterePerformance::factory()->createOne([
            'numero' => "",
            'texte' => "Ajout correct de composants amovibles.",
            'element_competence_id' => $elementCompetence00Q11->id,
            'isExpanded' => false
        ]);

        $critereComp00Q14 = CriterePerformance::factory()->createOne([
            'numero' => "",
            'texte' => "Raccordement correct des périphériques.",
            'element_competence_id' => $elementCompetence00Q11->id,
            'isExpanded' => false
        ]);

        $critereComp00Q15 = CriterePerformance::factory()->createOne([
            'numero' => "",
            'texte' => "Positionnement ergonomique de l’ordinateur et de ses périphériques.",
            'element_competence_id' => $elementCompetence00Q11->id,
            'isExpanded' => false
        ]);


        $elementCompetence00Q12 = ElementCompetence::all()->where('texte', '=', 'Installer le système d’exploitation.')->first();

        $critereComp00Q121 = CriterePerformance::factory()->createOne([
            'numero' => "",
            'texte' => "Utilisation appropriée des utilitaires de préparation des systèmes de fichiers.",
            'element_competence_id' => $elementCompetence00Q12->id,
            'isExpanded' => false
        ]);

        $critereComp00Q122 = CriterePerformance::factory()->createOne([
            'numero' => "",
            'texte' => "Application correcte de la procédure d’installation du système d’exploitation et des pilotes.",
            'element_competence_id' => $elementCompetence00Q12->id,
            'isExpanded' => false
        ]);

        $critereComp00Q123 = CriterePerformance::factory()->createOne([
            'numero' => "",
            'texte' => "Configuration correcte du système d’exploitation et des pilotes.",
            'element_competence_id' => $elementCompetence00Q12->id,
            'isExpanded' => false
        ]);

        $critereComp00Q124 = CriterePerformance::factory()->createOne([
            'numero' => "",
            'texte' => "Personnalisation du système d’exploitation en fonction des besoins des utilisatrices
                        et des utilisateurs.",
            'element_competence_id' => $elementCompetence00Q12->id,
            'isExpanded' => false
        ]);


        $elementCompetence00Q13 = ElementCompetence::all()->where('texte', '=', 'Installer des applications.')->first();

        $critereComp00Q131 = CriterePerformance::factory()->createOne([
            'numero' => "",
            'texte' => "Application correcte de la procédure d’installation des applications et des modules
                        d’extension.",
            'element_competence_id' => $elementCompetence00Q13->id,
            'isExpanded' => false
        ]);

        $critereComp00Q132 = CriterePerformance::factory()->createOne([
            'numero' => "",
            'texte' => "Configuration correcte des applications et des modules d’extension.",
            'element_competence_id' => $elementCompetence00Q13->id,
            'isExpanded' => false
        ]);

        $critereComp00Q133 = CriterePerformance::factory()->createOne([
            'numero' => "",
            'texte' => "Personnalisation des applications en fonction des besoins des utilisatrices et des utilisateurs.",
            'element_competence_id' => $elementCompetence00Q13->id,
            'isExpanded' => false
        ]);

        $critereComp00Q134 = CriterePerformance::factory()->createOne([
            'numero' => "",
            'texte' => "Fonctionnement correct des applications.",
            'element_competence_id' => $elementCompetence00Q13->id,
            'isExpanded' => false
        ]);


        $elementCompetence00Q14 = ElementCompetence::all()->where('texte', '=', 'Effectuer des tâches de gestion du système d’exploitation.')->first();

        $critereComp00Q141 = CriterePerformance::factory()->createOne([
            'numero' => "",
            'texte' => "Organisation fonctionnelle de la structure des fichiers et des répertoires.",
            'element_competence_id' => $elementCompetence00Q14->id,
            'isExpanded' => false
        ]);

        $critereComp00Q142 = CriterePerformance::factory()->createOne([
            'numero' => "",
            'texte' => "Utilisation appropriée des utilitaires d’archivage et de compression.",
            'element_competence_id' => $elementCompetence00Q14->id,
            'isExpanded' => false
        ]);

        $critereComp00Q143 = CriterePerformance::factory()->createOne([
            'numero' => "",
            'texte' => "Création correcte des comptes et des groupes d’utilisateurs.",
            'element_competence_id' => $elementCompetence00Q14->id,
            'isExpanded' => false
        ]);

        $critereComp00Q144 = CriterePerformance::factory()->createOne([
            'numero' => "",
            'texte' => "Attribution correcte des droits d’accès.",
            'element_competence_id' => $elementCompetence00Q14->id,
            'isExpanded' => false
        ]);

        $critereComp00Q145 = CriterePerformance::factory()->createOne([
            'numero' => "",
            'texte' => "Gestion appropriée des processus, de la mémoire et de l’espace disque.",
            'element_competence_id' => $elementCompetence00Q14->id,
            'isExpanded' => false
        ]);

        $critereComp00Q146 = CriterePerformance::factory()->createOne([
            'numero' => "",
            'texte' => "Rédaction correcte de scripts.",
            'element_competence_id' => $elementCompetence00Q14->id,
            'isExpanded' => false
        ]);


        // Critere de la competence 00Q2 //

        $elementCompetence00Q21 = ElementCompetence::all()->where('texte', '=', 'Analyser le problème.')->first();

        $critereComp00Q21 = CriterePerformance::factory()->createOne([
            'numero' => "",
            'texte' => "Décomposition correcte du problème.",
            'element_competence_id' => $elementCompetence00Q21->id,
            'isExpanded' => false
        ]);

        $critereComp00Q22 = CriterePerformance::factory()->createOne([
            'numero' => "",
            'texte' => "Détermination correcte des données d’entrée, des données de sortie et de la nature
                        des traitements.",
            'element_competence_id' => $elementCompetence00Q21->id,
            'isExpanded' => false
        ]);

        $critereComp00Q23 = CriterePerformance::factory()->createOne([
            'numero' => "",
            'texte' => "Choix et adaptation appropriés de l’algorithme.",
            'element_competence_id' => $elementCompetence00Q21->id,
            'isExpanded' => false
        ]);


        $elementCompetence00Q22 = ElementCompetence::all()->where('texte', '=', 'Traduire l’algorithme dans le langage de programmation.')->first();

        $critereComp00Q221 = CriterePerformance::factory()->createOne([
            'numero' => "",
            'texte' => "Choix approprié des instructions et des types de données élémentaires.",
            'element_competence_id' => $elementCompetence00Q22->id,
            'isExpanded' => false
        ]);

        $critereComp00Q222 = CriterePerformance::factory()->createOne([
            'numero' => "",
            'texte' => "Découpage efficace du code informatique.",
            'element_competence_id' => $elementCompetence00Q22->id,
            'isExpanded' => false
        ]);

        $critereComp00Q223 = CriterePerformance::factory()->createOne([
            'numero' => "",
            'texte' => "Organisation logique des instructions.",
            'element_competence_id' => $elementCompetence00Q22->id,
            'isExpanded' => false
        ]);

        $critereComp00Q224 = CriterePerformance::factory()->createOne([
            'numero' => "",
            'texte' => "Respect de la syntaxe du langage.",
            'element_competence_id' => $elementCompetence00Q22->id,
            'isExpanded' => false
        ]);

        $critereComp00Q225 = CriterePerformance::factory()->createOne([
            'numero' => "",
            'texte' => "Code informatique conforme à l’algorithme.",
            'element_competence_id' => $elementCompetence00Q22->id,
            'isExpanded' => false
        ]);


        $elementCompetence00Q23 = ElementCompetence::all()->where('texte', '=', 'Déboguer le code.')->first();

        $critereComp00Q231 = CriterePerformance::factory()->createOne([
            'numero' => "",
            'texte' => "Utilisation efficace du débogueur.",
            'element_competence_id' => $elementCompetence00Q23->id,
            'isExpanded' => false
        ]);

        $critereComp00Q232 = CriterePerformance::factory()->createOne([
            'numero' => "",
            'texte' => "Repérage complet des erreurs.",
            'element_competence_id' => $elementCompetence00Q23->id,
            'isExpanded' => false
        ]);

        $critereComp00Q233 = CriterePerformance::factory()->createOne([
            'numero' => "",
            'texte' => "Détermination judicieuse de stratégies de correction des erreurs.",
            'element_competence_id' => $elementCompetence00Q23->id,
            'isExpanded' => false
        ]);

        $critereComp00Q234 = CriterePerformance::factory()->createOne([
            'numero' => "",
            'texte' => "Pertinence des correctifs.",
            'element_competence_id' => $elementCompetence00Q23->id,
            'isExpanded' => false
        ]);

        $critereComp00Q235 = CriterePerformance::factory()->createOne([
            'numero' => "",
            'texte' => " Notation claire des solutions aux problèmes rencontrés.",
            'element_competence_id' => $elementCompetence00Q23->id,
            'isExpanded' => false
        ]);


        $elementCompetence00Q24 = ElementCompetence::all()->where('texte', '=', 'Appliquer le plan de tests fonctionnels.')->first();

        $critereComp00Q241 = CriterePerformance::factory()->createOne([
            'numero' => "",
            'texte' => "Manifestation d’attitudes et de comportements empreints de rigueur.",
            'element_competence_id' => $elementCompetence00Q24->id,
            'isExpanded' => false
        ]);

        $critereComp00Q242 = CriterePerformance::factory()->createOne([
            'numero' => "",
            'texte' => "Repérage complet des erreurs de fonctionnement.",
            'element_competence_id' => $elementCompetence00Q24->id,
            'isExpanded' => false
        ]);

        $critereComp00Q243 = CriterePerformance::factory()->createOne([
            'numero' => "",
            'texte' => "Pertinence des correctifs.",
            'element_competence_id' => $elementCompetence00Q24->id,
            'isExpanded' => false
        ]);

        $critereComp00Q244 = CriterePerformance::factory()->createOne([
            'numero' => "",
            'texte' => "Fonctionnement correct du programme.",
            'element_competence_id' => $elementCompetence00Q24->id,
            'isExpanded' => false
        ]);

        $critereComp00Q245 = CriterePerformance::factory()->createOne([
            'numero' => "",
            'texte' => "Notation claire de l’information relative aux tests et à leurs résultats.",
            'element_competence_id' => $elementCompetence00Q24->id,
            'isExpanded' => false
        ]);





    }
}
