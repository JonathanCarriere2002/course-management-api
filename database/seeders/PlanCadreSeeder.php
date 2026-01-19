<?php

/**
 * @author Jacob Beauregard-Tousignant
 */

namespace Database\Seeders;

use App\Models\Competence;
use App\Models\CritereEvaluation;
use App\Models\ElementCompetence;
use App\Models\Gabarit;
use App\Models\PlanCadre;
use App\Models\Programme;
use App\Models\Section;
use App\Models\Session;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlanCadreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Aller chercher le gabarit du plan-cadre
        $gabarit = Gabarit::where('nom', '=', 'Gabarit plan-cadre')->first();

        //Aller chercher les sections des plans-cadres du gabarit
        $intentionsEducatives = Section::all()->where('titre', '=', 'INTENTIONS ÉDUCATIVES')->first();
        $intentionsPedagogiques = Section::all()->where('titre', '=', 'INTENTIONS PÉDAGOGIQUES')->first();
        $description = Section::all()->where('titre', '=', 'DESCRIPTION DU COURS')->first();
        $attitudes = Section::all()->where('titre', '=', 'ATTITUDES')->first();

        $listeSections = [$intentionsEducatives, $intentionsPedagogiques, $description, $attitudes];

        //Session à ajouter aux plans cadres
        $session = Session::all()->first();

        //Programme à ajouter aux plans cadres
        $techniquesInfo = Programme::all()->where('code', '=', '420.B0')->first();

        //Aller chercher des compétences pour les assigner aux plans cadres
        $competence1 = Competence::find(1);
        $competence2 = Competence::find(2);


        $contenuLocal1 = 'Création d’un environnement de tests d’intrusions avec des outils appropriés ( Kali linux, VMware, VirtualBox, Hyper-V, Metasploitable, code vulnérable, ... )';
        $contenuLocal2 = 'Test d’intrusion ( force brute, homme du milieu, « Hijacking », déni de service ... )';
        $contenuLocal3 = 'Sécurité du service contre l’injection : Failles d’injection (SQL, XML ...), chiffrement des données privées, ...';
        $contenuLocal4 = 'Sécurité côté client : navigateur, application native, application mobile, failles (XSS, CSRF, HTML, ...)';
        $contenuLocal5 = '-	Présentation d’outils de représentation des algorithmes (ex. organigramme, pseudo-code, etc.) Vérification d’un algorithme à savoir s’il permet de résoudre un problème donné';

        $listContenuLocaux = [$contenuLocal1, $contenuLocal2, $contenuLocal3, $contenuLocal4, $contenuLocal5];



        //Créer des plans cadres représentatifs de base
        $logiqueProg = PlanCadre::factory()->createOne([
            "code" => "420-1G2-HU",
            "titre" => "Logique de programmation",
            "ponderation" => "3-4-4",
            "unites" => 3.66,
            "attitudes" => "Rigueur",
            "complet"=>true,


            "ponderationFinale" => 60,
            "changement" => date('Y-m-d'),
            "dateApprobationDepartement" => null,
            "dateApprobationComiteProgrammes" => null,
            "dateDepotDirectionEtudes" => null
        ]);

        //Associer le gabarit
        $logiqueProg->associer_gabarit($gabarit->id);

        //Associer les sections
//        $logiqueProg->

        $logiqueProg->associer_session($session);
        $logiqueProg->associer_programme($techniquesInfo);

        $logiqueProg->ajouter_competence_partielle($competence1, 'Utilisation simple d’un système de gestion de versions (ex. Git) : commit, push, clone', "1 de 5");
        $logiqueProg->ajouter_competence_complete($competence2, 'Utilisation simple d’un système de gestion de versions (ex. Git) : commit, push, clone');

        $progOrienteeObjet = PlanCadre::factory()->createOne([
            "code" => "420-2G2-HU",
            "titre" => "Programmation orientée objet",
            "ponderation" => "3-4-4",
            "unites" => 3.66,

            "attitudes" => "Rigueur, autonomie, son initiative et sa débrouillardise",
            "complet"=>true,


            "ponderationFinale" => 60,
            "changement" => date('Y-m-d'),
            "dateApprobationDepartement" => null,
            "dateApprobationComiteProgrammes" => null,
            "dateDepotDirectionEtudes" => null
        ]);

        //Associer le gabarit
        $progOrienteeObjet->associer_gabarit($gabarit->id);

        $progOrienteeObjet->associer_session($session);
        $progOrienteeObjet->associer_programme($techniquesInfo);

        $progOrienteeObjet->ajouter_competence_partielle($competence1, 'Utilisation simple d’un système de gestion de versions (ex. Git) : commit, push, clone', "2 de 5");
        $progOrienteeObjet->ajouter_competence_complete($competence2, 'Utilisation simple d’un système de gestion de versions (ex. Git) : commit, push, clone');


        $appWindows = PlanCadre::factory()->createOne([
            "code" => "420-3P3-HU",
            "titre" => "Développement d'application Windows",
            "ponderation" => "2-2-1",
            "unites" => 2.33,
            "attitudes" => "Rigueur, autonomie, soucis d'efficacité et de concision",
            "complet"=>true,


            "ponderationFinale" => 60,
            "changement" => date('Y-m-d'),
            "dateApprobationDepartement" => null,
            "dateApprobationComiteProgrammes" => null,
            "dateDepotDirectionEtudes" => null
        ]);
        //Associer les sections

        //Associer le gabarit
        $appWindows->associer_gabarit($gabarit->id);


        $appWindows->associer_session($session);
        $appWindows->associer_programme($techniquesInfo);


        $appWindows->ajouter_competence_partielle($competence1, 'Utilisation simple d’un système de gestion de versions (ex. Git) : commit, push, clone', "3 de 5");
        $appWindows->ajouter_competence_complete($competence2, 'Utilisation simple d’un système de gestion de versions (ex. Git) : commit, push, clone');



        $projetSynthese = PlanCadre::factory()->createOne([
            "code" => "420-5A1-HU",
            "titre" => "Projet synthèse ",
            "ponderation" => "3-3-2",
            "unites" => 2.33,
            "attitudes" => "Capacité à travailler en équipe et organisation du travail.",
            "complet"=>true,


            "ponderationFinale" => 60,
            "changement" => date('Y-m-d'),
            "dateApprobationDepartement" => null,
            "dateApprobationComiteProgrammes" => null,
            "dateDepotDirectionEtudes" => null
        ]);

        //Associer le gabarit
        $projetSynthese->associer_gabarit($gabarit->id);

        $projetSynthese->associer_session($session);
        $projetSynthese->associer_programme($techniquesInfo);


        $projetSynthese->ajouter_competence_partielle($competence1, 'Utilisation simple d’un système de gestion de versions (ex. Git) : commit, push, clone', "4 de 5");
        $projetSynthese->ajouter_competence_complete($competence2, 'Utilisation simple d’un système de gestion de versions (ex. Git) : commit, push, clone');




        $conceptionLogiciels = PlanCadre::factory()->createOne([
            "code" => "420-5A2-HU",
            "titre" => "Conception de logiciels",
            "ponderation" => "3-5-2",
            "unites" => 2.33,
            "attitudes" => "Rigueur, autonomie, soucis d'efficacité et de concision",
            "complet"=>true,


            "ponderationFinale" => 60,
            "changement" => date('Y-m-d'),
            "dateApprobationDepartement" => null,
            "dateApprobationComiteProgrammes" => null,
            "dateDepotDirectionEtudes" => null
        ]);

        //Associer le gabarit
        $conceptionLogiciels->associer_gabarit($gabarit->id);

        $conceptionLogiciels->associer_session($session);
        $conceptionLogiciels->associer_programme($techniquesInfo);


        $conceptionLogiciels->ajouter_competence_partielle($competence1, 'Utilisation simple d’un système de gestion de versions (ex. Git) : commit, push, clone', "5 de 5");
        $conceptionLogiciels->ajouter_competence_complete($competence2, 'Utilisation simple d’un système de gestion de versions (ex. Git) : commit, push, clone');



        //Faire les liens entre les plans cadres
        $progOrienteeObjet->ajouterPlanCadrePrealableRelatif($logiqueProg->id);
        $logiqueProg->ajouterPlanCadreSuivant($progOrienteeObjet->id);
        $appWindows->ajouterPlanCadrePrealableAbsolu($progOrienteeObjet->id);
        $progOrienteeObjet->ajouterPlanCadreSuivant($appWindows->id);

        $conceptionLogiciels->ajouterPlanCadreCorequis($projetSynthese->id);
        $projetSynthese->ajouterPlanCadreCorequis($conceptionLogiciels->id);


        $listePlansCadres = [$logiqueProg, $progOrienteeObjet, $appWindows, $projetSynthese, $conceptionLogiciels];

        foreach ($listePlansCadres as $planCadre){
            foreach ($planCadre->competence as $competence){
                foreach ($competence->elements_competences as $elements_competence){
                    $planCadre->ajouterElementCompetence($elements_competence->id, fake()->randomElement($listContenuLocaux));
                }
            }
        }

        //Aller chercher des éléments de compétence pour assigner aux critères
        $elementCompetence1 = ElementCompetence::all()->first();
        $elementCompetence2 = ElementCompetence::all()->last();

        //Ajouter des critères d'évaluations
        $critereEval11 = CritereEvaluation::factory()->createOne([
            "plan_cadre_id"=>$logiqueProg->id,
            "enonce"=>"Analyser le problème.",
            "ponderation"=>10
        ]);
        $critereEval11->ajouterElementCompetence($elementCompetence1->id);
        $critereEval11->ajouterElementCompetence($elementCompetence2->id);

        $critereEval12 = CritereEvaluation::factory()->createOne([
            "plan_cadre_id"=>$logiqueProg->id,
            "enonce"=>"Traduire l’algorithme dans le langage de programmation.",
            "ponderation"=>50
        ]);
        $critereEval12->ajouterElementCompetence($elementCompetence1->id);
        $critereEval12->ajouterElementCompetence($elementCompetence2->id);

        $critereEval13 = CritereEvaluation::factory()->createOne([
            "plan_cadre_id"=>$logiqueProg->id,
            "enonce"=>"Déboguer le code.",
            "ponderation"=>20
        ]);
        $critereEval13->ajouterElementCompetence($elementCompetence1->id);

        $critereEval14 = CritereEvaluation::factory()->createOne([
            "plan_cadre_id"=>$logiqueProg->id,
            "enonce"=>"Appliquer le plan de tests fonctionnels.",
            "ponderation"=>20
        ]);

        $critereEval21 = CritereEvaluation::factory()->createOne([
            "plan_cadre_id"=>$progOrienteeObjet->id,
            "enonce"=>"Analyse adéquate du problème",
            "ponderation"=>10
        ]);
        $critereEval22 = CritereEvaluation::factory()->createOne([
            "plan_cadre_id"=>$progOrienteeObjet->id,
            "enonce"=>"Production des algorithmes justes pour les méthodes",
            "ponderation"=>75
        ]);
        $critereEval22->ajouterElementCompetence($elementCompetence2->id);

        $critereEval23 = CritereEvaluation::factory()->createOne([
            "plan_cadre_id"=>$progOrienteeObjet->id,
            "enonce"=>"Génération d'interface graphique ergonomique et conviviale",
            "ponderation"=>5
        ]);
        $critereEval23->ajouterElementCompetence($elementCompetence1->id);
        $critereEval23->ajouterElementCompetence($elementCompetence2->id);

        $critereEval24 = CritereEvaluation::factory()->createOne([
            "plan_cadre_id"=>$progOrienteeObjet->id,
            "enonce"=>"Documentation claire, juste et en conformité avec le guide de programmation du département",
            "ponderation"=>10
        ]);
        $critereEval24->ajouterElementCompetence($elementCompetence1->id);

        $critereEval31 = CritereEvaluation::factory()->createOne([
            "plan_cadre_id"=>$appWindows->id,
            "enonce"=>"Analyse et préparation correcte du projet de développement de l’application selon le devis et les normes",
            "ponderation"=>15
        ]);
        $critereEval31->ajouterElementCompetence($elementCompetence1->id);
        $critereEval31->ajouterElementCompetence($elementCompetence2->id);

        $critereEval32 = CritereEvaluation::factory()->createOne([
            "plan_cadre_id"=>$appWindows->id,
            "enonce"=>"Programmation rigoureuse de l’interface et de la logique applicative selon les normes et spécifications",
            "ponderation"=>55
        ]);


        $critereEval33 = CritereEvaluation::factory()->createOne([
            "plan_cadre_id"=>$appWindows->id,
            "enonce"=>"Application rigoureuse du plan de tests unitaires selon les normes et spécifications",
            "ponderation"=>15
        ]);
        $critereEval33->ajouterElementCompetence($elementCompetence1->id);

        $critereEval34 = CritereEvaluation::factory()->createOne([
            "plan_cadre_id"=>$appWindows->id,
            "enonce"=>"Déploiement et documentation correcte de l'application selon les normes et spécifications",
            "ponderation"=>15
        ]);
        $critereEval34->ajouterElementCompetence($elementCompetence2->id);
    }
}
