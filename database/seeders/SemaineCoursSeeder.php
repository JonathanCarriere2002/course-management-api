<?php

namespace Database\Seeders;

use App\Models\ElementCompetence;
use App\Models\PlanCours;
use App\Models\SemaineCours;
use Illuminate\Database\Seeder;

/**
 * Seeder permettant d'insérer des données initiales pour les semaines de cours dans la base de données
 * @author Jonathan Carrière
 */
class SemaineCoursSeeder extends Seeder
{
    /**
     * Insérer les objets dans la base de données
     */
    public function run(): void
    {
        // Liste contenant l'ensemble des éléments de compétences dans la base de données
        $elementsCompetence = ElementCompetence::all();

        // Liste contenant l'ensemble des plans de cours dans la base de données
        $plansCours = PlanCours::all();

        // Insérer une semaine de cours et effectuer ses associations
        $semaine01 = SemaineCours::factory()->createOne([
            "semaineDebut" => 1,
            "semaineFin" => 1,
            "activites" => "<p><strong>Activités d'introduction à la programmation en Python</strong></p>",
            "contenu" => "<p><strong>Concepts de programmation</strong></p><p><br></p><p><strong>Expressions numériques et logiques</strong></p><p><br></p><p><strong>Opérateurs arithmétiques, logiques et de comparaisons Algorithmie :</strong></p><ul><li>Compréhension de la demande</li><li>Notions d’entrées et de sorties</li><li>Séquencement des opérations</li></ul><p><br></p><p><strong>Environnement de travail Colab</strong></p>"
        ]);
        $semaine01->associerElementsCompetencesSeeder($plansCours[0]->id, 0);
        $semaine01->associerPlanCours($plansCours[0]->id);

        // Insérer une semaine de cours et effectuer ses associations
        $semaine02 = SemaineCours::factory()->createOne([
            "semaineDebut" => 2,
            "semaineFin" => 3,
            "activites" => "<p><strong>Activités d'introduction à la programmation en Python (suite)</strong></p>",
            "contenu" => "<p><strong>Notions de variables :</strong></p><ul><li>Définition (variable vs constante)</li><li>Affectation de valeur</li><li>Types de variables</li></ul><p><br></p><p><strong>Traitements séquentiels</strong></p>"
        ]);
        $semaine02->associerElementsCompetencesSeeder($plansCours[0]->id, 2);
        $semaine02->associerPlanCours($plansCours[0]->id);

        // Insérer une semaine de cours et effectuer ses associations
        $semaine03 = SemaineCours::factory()->createOne([
            "semaineDebut" => 4,
            "semaineFin" => 7,
            "activites" => "<p><strong>Laboratoires formatifs</strong></p><p><br></p><p><strong>Projet évalué sur les notions de base de la programmation (10%)</strong></p>",
            "contenu" => "<p><strong>Environnement de travail IDE (PyCharm, Visual studio ou Visual code …)</strong></p><p><br></p><p><strong>Outils de débogage (manuel et débogueur)</strong></p><p><br></p><p><strong>Introduction aux notions d’erreurs :</strong></p><ul><li>de syntaxe</li><li>d’exécution</li><li>de logique – débogueur&nbsp;</li></ul><p><br></p><p><strong>Les tests logiques</strong></p>"
        ]);
        $semaine03->associerElementsCompetencesSeeder($plansCours[0]->id, 3);
        $semaine03->associerPlanCours($plansCours[0]->id);

        // Insérer une semaine de cours et effectuer ses associations
        $semaine04 = SemaineCours::factory()->createOne([
            "semaineDebut" => 8,
            "semaineFin" => 11,
            "activites" => "<p><strong>Présentation de l’énoncé du projet synthèse</strong></p><p><br></p><p><strong>Projet intra : 20%</strong></p>",
            "contenu" => "<p><strong>Modularisation :</strong></p><ul><li>Modules existant</li><li>Les procédures</li></ul>"
        ]);
        $semaine04->associerElementsCompetencesSeeder($plansCours[0]->id, 2);
        $semaine04->associerPlanCours($plansCours[0]->id);

        // Insérer une semaine de cours et effectuer ses associations
        $semaine05 = SemaineCours::factory()->createOne([
            "semaineDebut" => 12,
            "semaineFin" => 15,
            "activites" => "<p><strong>Projet synthèse : 60%</strong></p>",
            "contenu" => "<p><strong>Modularisation :</strong></p><ul><li>Fonctions avec valeur de retour</li><li>Le passage de paramètres</li></ul><p><br></p>"
        ]);
        $semaine05->associerElementsCompetencesSeeder($plansCours[0]->id, 5);
        $semaine05->associerPlanCours($plansCours[0]->id);

        // Insérer une semaine de cours et effectuer ses associations
        $semaine06 = SemaineCours::factory()->createOne([
            "semaineDebut" => 1,
            "semaineFin" => 1,
            "activites" => "<p><strong>Activités d'introduction à la programmation orientée objet</strong></p>",
            "contenu" => "<p><strong>Révision :</strong></p><ul><li>Notions de base du cours précédent (1G2)</li><li>Modularisation</li><li>Normes de programmation, nomenclature et documentation</li><li>Portée/étendue des objets</li><li>Utilisation du débogueur</li><li>Tests unitaires</li></ul><p><br></p><p><strong>Mise à niveau :</strong></p><ul><li>Lecture et écriture de fichiers textes</li><li>Collections : Dictionnaire et tuples</li><li>Collection de collections</li><li>Notion de projet multi-feuilles de code</li><li>Autres : datetime; pprint</li></ul>"
        ]);
        $semaine06->associerElementsCompetencesSeeder($plansCours[1]->id, 0);
        $semaine06->associerPlanCours($plansCours[1]->id);

        // Insérer une semaine de cours et effectuer ses associations
        $semaine07 = SemaineCours::factory()->createOne([
            "semaineDebut" => 2,
            "semaineFin" => 3,
            "activites" => "<p><strong>Premier laboratoire noté (10%)</strong></p>",
            "contenu" => "<p><strong>Introduction au versionnage avec GIT</strong></p><p><br></p><p><strong>Introduction à l’orienté objet :</strong></p><ul><li>Terminologie (vocabulaire de base de la POO)</li></ul><p><br></p><p><strong>Classes :</strong></p><ul><li>Instruction class</li><li>Attributs et propriétés d’une classe</li></ul><p><br></p><p><strong>Instanciation d’objets :</strong></p><ul><li>Instanciation et attributs</li></ul>"
        ]);
        $semaine07->associerElementsCompetencesSeeder($plansCours[1]->id, 2);
        $semaine07->associerPlanCours($plansCours[1]->id);

        // Insérer une semaine de cours et effectuer ses associations
        $semaine08 = SemaineCours::factory()->createOne([
            "semaineDebut" => 4,
            "semaineFin" => 7,
            "activites" => "<p><strong>Création de programmes permettant de manipuler des objets</strong></p><p><br></p><p><strong>Tests unitaires</strong></p>",
            "contenu" => "<p><strong>Introduction à la création d’interface graphique avec QT Designer</strong></p><p><br></p><p><strong>Gestion d’événements</strong></p><p><br></p><p><strong>Instanciation d’objets, avec ou sans collection :</strong></p><ul><li>Méthodes d’une classe</li><li>Espace de nom des classes et instances</li><li>Collections d’objets</li></ul>"
        ]);
        $semaine08->associerElementsCompetencesSeeder($plansCours[1]->id, 3);
        $semaine08->associerPlanCours($plansCours[1]->id);

        // Insérer une semaine de cours et effectuer ses associations
        $semaine09 = SemaineCours::factory()->createOne([
            "semaineDebut" => 8,
            "semaineFin" => 11,
            "activites" => "<p><strong>Projet Intra (30%)</strong></p>",
            "contenu" => "<p><strong>Notation UML (Unified Modelling Language) de base :</strong></p><ul><li>Qu’est-ce que la modélisation</li><li>Composants d’un UML et ses utilisations</li><li>Diagramme de l’architecture du système</li><li>Diagramme de classe</li></ul>"
        ]);
        $semaine09->associerElementsCompetencesSeeder($plansCours[1]->id, 2);
        $semaine09->associerPlanCours($plansCours[1]->id);

        // Insérer une semaine de cours et effectuer ses associations
        $semaine10 = SemaineCours::factory()->createOne([
            "semaineDebut" => 12,
            "semaineFin" => 15,
            "activites" => "<p><strong>Complétion du projet final (60%)</strong></p>",
            "contenu" => "<p><strong>Classes avec composition/association :</strong></p><ul><li>Sérialisation / désérialisation avec JSON</li></ul>"
        ]);
        $semaine10->associerElementsCompetencesSeeder($plansCours[1]->id, 5);
        $semaine10->associerPlanCours($plansCours[1]->id);

        // Insérer une semaine de cours et effectuer ses associations
        $semaine11 = SemaineCours::factory()->createOne([
            "semaineDebut" => 1,
            "semaineFin" => 1,
            "activites" => "<p><strong>Syntaxe de C#</strong></p><p><br></p><p><strong>Installation de Visual Studio 2019</strong></p>",
            "contenu" => "<p><strong>Présentation du plan de cours</strong></p><p><br></p><p><strong>Introduction et exploration de l’environnement Visual Studio :</strong></p><ul><li>Notions de solution et de projet</li><li>Application de type console vs form</li></ul>"
        ]);
        $semaine11->associerElementsCompetencesSeeder($plansCours[2]->id, 0);
        $semaine11->associerPlanCours($plansCours[2]->id);

        // Insérer une semaine de cours et effectuer ses associations
        $semaine12 = SemaineCours::factory()->createOne([
            "semaineDebut" => 2,
            "semaineFin" => 3,
            "activites" => "<p><strong>Première évaluation (10%)</strong></p>",
            "contenu" => "<p><strong>Révision des notions du cours précédent</strong></p><p><br></p><p><strong>L’orienté objet dans l’IDE VS :</strong></p><ul><li>Définir une classe et créer un objet</li><li>Encapsulation : Propriétés et méthodes d'accès</li><li>Constructeurs</li><li>La méthode ToString</li><li>Les méthodes utilitaires</li><li>Classes et Membres Static vs Public</li></ul><p><br></p><p><strong>Le débogage et gestion des erreurs :</strong></p><ul><li>Débogueur de VS</li><li>Exécution du programme pas à pas</li><li>Utilisation de la structure try…catch</li></ul>"
        ]);
        $semaine12->associerElementsCompetencesSeeder($plansCours[2]->id, 2);
        $semaine12->associerPlanCours($plansCours[2]->id);

        // Insérer une semaine de cours et effectuer ses associations
        $semaine13 = SemaineCours::factory()->createOne([
            "semaineDebut" => 4,
            "semaineFin" => 7,
            "activites" => "<p><strong>Suite des activités de programmation en C#</strong></p>",
            "contenu" => "<p><strong>Analyse du document de conception :</strong></p><ul><li>Présentation du diagramme des cas d'utilisation</li><li>Réalisation du diagramme des cas d'utilisation qui correspond au document d'analyse fourni</li></ul><p><br></p><p><strong>Normes de programmation et nomenclature</strong></p><p><br></p><p><strong>Le versionnage avec GIT dans VS</strong></p><p><br></p><p>Effectuer des tests pour l'application :</p><ul><li>Création d'un projet de tests unitaires</li><li>Tester nos classes à l'aide d'un plan</li></ul>"
        ]);
        $semaine13->associerElementsCompetencesSeeder($plansCours[2]->id, 3);
        $semaine13->associerPlanCours($plansCours[2]->id);

        // Insérer une semaine de cours et effectuer ses associations
        $semaine14 = SemaineCours::factory()->createOne([
            "semaineDebut" => 8,
            "semaineFin" => 11,
            "activites" => "<p><strong>Projet intra 30% de la note finale</strong></p>",
            "contenu" => "<p><strong>Gestions des événements :</strong></p><ul><li>Écouteur pour un seul événement</li><li>Écouteur pour plusieurs événements</li><li>Événement pour plusieurs écouteurs</li></ul><p><br></p><p><strong>Validation des données du formulaire :</strong></p><ul><li>En utilisant la méthode classique</li><li>En utilisant les expressions régulières</li></ul>"
        ]);
        $semaine14->associerElementsCompetencesSeeder($plansCours[2]->id, 2);
        $semaine14->associerPlanCours($plansCours[2]->id);

        // Insérer une semaine de cours et effectuer ses associations
        $semaine15 = SemaineCours::factory()->createOne([
            "semaineDebut" => 12,
            "semaineFin" => 15,
            "activites" => "<p><strong>Complétion et remise du projet synthèse 60% de la note finale</strong></p>",
            "contenu" => "<p><strong>Gestions des événements :</strong></p><ul><li>Écouteur pour un seul événement</li><li>Écouteur pour plusieurs événements</li><li>Événement pour plusieurs écouteurs</li></ul><p><br></p><p><strong>Validation des données du formulaire :</strong></p><ul><li>En utilisant la méthode classique</li><li>En utilisant les expressions régulières</li></ul><p><br></p>"
        ]);
        $semaine15->associerElementsCompetencesSeeder($plansCours[2]->id, 5);
        $semaine15->associerPlanCours($plansCours[2]->id);

    }

}
