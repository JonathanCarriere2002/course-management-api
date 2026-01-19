<?php
/**
 * @author Jacob Beauregard-Tousignant
 */


namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlanCadreSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('plan_cadre_section')->insert([
            //Logique de prog
            [
                //INTENTIONS ÉDUCATIVES
                'plan_cadre_id' => 1,
                'section_id' => 10,
                'texte' => "<p>Les intentions éducatives en formation spécifique s’appuient sur des valeurs et préoccupations importantes et qui servent de guide aux interventions auprès de l’étudiante ou de l’étudiant. Elles touchent généralement des dimensions significatives du développement professionnel et personnel qui n’ont pas fait l’objet de formulations explicites au niveau des buts de la formation ou des objectifs et standards. Elles peuvent porter sur des attitudes importantes, des habitudes de travail, des habiletés intellectuelles, etc.\nEn conformité avec les visées de la formation collégiale, la formation spécifique vise aussi à former la personne à vivre en société de façon responsable, à amener la personne à intégrer les acquis de la culture et, enfin, à amener la personne à maîtriser la langue comme outil de pensée, de communication et d’ouverture sur le monde.\nPour le programme Techniques de l’informatique, les intentions éducatives en formation spécifique sont les suivantes :\n•\tdévelopper l’autonomie et favoriser la polyvalence;\n•\tdévelopper le sens de l’abstraction;\n•\tpromouvoir les valeurs d’équité en matière d’accès aux technologies informatiques.\n</p>",
                'info_suppl' => "pages 15 et 16 du devis de 2023",
            ],
            [
                //Compétences
                'plan_cadre_id' => 1,
                'section_id' => 9,
                'texte' => '',
                'info_suppl' => "",
            ],
            [
                //INTENTIONS PÉDAGOGIQUES
                'plan_cadre_id' => 1,
                'section_id' => 11,
                'texte' => "<p>Cette compétence doit être atteinte dans un contexte global d’apprentissage des différentes étapes méthodologiques de la programmation dans un environnement représentatif du milieu de travail Elle expose l’étudiante et l’étudiant à développer une logique de programmation et à réaliser des programmes sécurités.\n\nObjectifs attendus :\n•\tAutonomie – initiative – débrouillardise – persévérance;\n•\tProgramme documenté par organisation logique avec respect des normes;\n•\tPrise de notes guidée;\n•\tStratégies de lecture sur sujets dictés; Stratégies de compréhension et d’application des procédures; Stratégies de recherche;\n•\tOrganisation de son travail par jour.\n•\tStratégie pédagogique qu’il suscite l’engagement des étudiants et qui facilite la transition secondaire-cégep;\n•\tRépondre à la demande;\n•\tSoucis de fonctionnalité;\n•\tSoucis de la justesse des résultats;\n•\tMettre les bases pour apprendre à travailler de façon rigoureuse.\n</p>",
                'info_suppl' => "",
            ],
            [
                //DESCRIPTION DU COURS
                'plan_cadre_id' => 1,
                'section_id' => 12,
                'texte' => "<p>Ce cours de session 1 permet à l’étudiante et l’étudiant d’apprendre les étapes méthodologiques de la programmation dans un environnement représentatif du milieu de travail. Il amène l’étudiante et l’étudiant à traduire une logique algorithmique en un langage de programmation en tenant compte des bonnes pratiques et des normes de sécurité de base. Ce cours est le préalable absolu du cours 420-2G4-HU Programmation orientée objet de la session 2. Il est aussi le préalable relatif du cours 420-3G2-HU Exploitation des bases de données de la session 3.</p>",
                'info_suppl' => "",
            ],
            [
                //ATTITUDES
                'plan_cadre_id' => 1,
                'section_id' => 13,
                'text' => '<p>Rigueur</p>',
                'info_suppl' => "",
            ],


            //POO
            [
                //INTENTIONS ÉDUCATIVES
                'plan_cadre_id' => 2,
                'section_id' => 10,
                'texte' => "<p>Les intentions éducatives en formation spécifique s’appuient sur des valeurs et préoccupations importantes et qui servent de guide aux interventions auprès de l’étudiante ou de l’étudiant. Elles touchent généralement des dimensions significatives du développement professionnel et personnel qui n’ont pas fait l’objet de formulations explicites au niveau des buts de la formation ou des objectifs et standards. Elles peuvent porter sur des attitudes importantes, des habitudes de travail, des habiletés intellectuelles, etc.\nEn conformité avec les visées de la formation collégiale, la formation spécifique vise aussi à former la personne à vivre en société de façon responsable, à amener la personne à intégrer les acquis de la culture et, enfin, à amener la personne à maîtriser la langue comme outil de pensée, de communication et d’ouverture sur le monde.\nPour le programme Techniques de l’informatique, les intentions éducatives en formation spécifique sont les suivantes :\n•\tdévelopper l’autonomie et favoriser la polyvalence;\n•\tdévelopper le sens de l’abstraction;\n•\tpromouvoir les valeurs d’équité en matière d’accès aux technologies informatiques.\n</p>",
                'info_suppl' => "pages 7 et 8 du devis de 2017",
            ],
            [
                //Compétences
                'plan_cadre_id' => 2,
                'section_id' => 9,
                'texte' => '',
                'info_suppl' => "",
            ],
            [
                //INTENTIONS PÉDAGOGIQUES
                'plan_cadre_id' => 2,
                'section_id' => 11,
                'texte' => "<p>À la fin du cours, l'étudiante ou l'étudiant sera capable d'identifier les acteurs d'une application et leurs interactions avec cette dernière. Elle ou il pourra produire et interpréter les modèles des cas d’utilisation, décrire les principes de base de l’orienté objet et appliquer les concepts d’abstraction, d’encapsulation, d’héritage et de polymorphisme. Elle ou il comprendra l'utilité de certains diagrammes UML, développera une application basée sur les classes, la testera, la déboguera et la déploiera.</p>",
                'info_suppl' => "",
            ],
            [
                //DESCRIPTION DU COURS
                'plan_cadre_id' => 2,
                'section_id' => 12,
                'texte' => "<p>Ce cours de 2e session initie l’étudiante ou l’étudiant aux mécanismes du développement et de la programmation orientés objets (DOO, POO) et l’utilisation de certains modèles UML. Il lui permet de se familiariser avec l’environnement de développement orienté objet, de pratiquer les notions de la programmation par objets et d’améliorer ses compétences dans les concepts de l’algorithmie et de la sécurité du code.</p>",
                'info_suppl' => "",
            ],
            [
                //ATTITUDES
                'plan_cadre_id' => 2,
                'section_id' => 13,
                'text' => '<p>Rigueur, autonomie, son initiative et sa débrouillardise</p>',
                'info_suppl' => "",
            ],


            //APP WINDOWS
            [
                //INTENTIONS ÉDUCATIVES
                'plan_cadre_id' => 3,
                'section_id' => 10,
                'texte' => "<p>Les intentions éducatives en formation spécifique s’appuient sur des valeurs et préoccupations importantes et qui servent de guide aux interventions auprès de l’étudiante ou de l’étudiant. Elles touchent généralement des dimensions significatives du développement professionnel et personnel qui n’ont pas fait l’objet de formulations explicites au niveau des buts de la formation ou des objectifs et standards. Elles peuvent porter sur des attitudes importantes, des habitudes de travail, des habiletés intellectuelles, etc.\nEn conformité avec les visées de la formation collégiale, la formation spécifique vise aussi à former la personne à vivre en société de façon responsable, à amener la personne à intégrer les acquis de la culture et, enfin, à amener la personne à maîtriser la langue comme outil de pensée, de communication et d’ouverture sur le monde.\nPour le programme Techniques de l’informatique, les intentions éducatives en formation spécifique sont les suivantes :\n•\tdévelopper l’autonomie et favoriser la polyvalence;\n•\tdévelopper le sens de l’abstraction;\n•\tpromouvoir les valeurs d’équité en matière d’accès aux technologies informatiques.\n</p>",
                'info_suppl' => "pages 15 à 17 du devis de 2020"
            ],
            [
                //Compétences
                'plan_cadre_id' => 3,
                'section_id' => 9,
                'texte' => '',
                'info_suppl' => "",
            ],
            [
                //INTENTIONS PÉDAGOGIQUES
                'plan_cadre_id' => 3,
                'section_id' => 11,
                'texte' => "<p>Dans ce cours l'étudiante ou l'étudiant apprendra à réaliser une application Windows\nrépondant aux caractéristiques et besoins des utilisateurs visés, en intégrant une base de\ndonnées à partir d'un document de conception fourni. Elle ou il sera en mesure de fournir un\nplan de tests pour l'application, de procéder à son déploiement et de fournir une\ndocumentation adéquate.</p>",
                'info_suppl' => "",
            ],
            [
                //DESCRIPTION DU COURS
                'plan_cadre_id' => 3,
                'section_id' => 12,
                'texte' => "<p>Ce cours de 3e session du profil Programmation et sécurité du programme 420.B0\nTechniques de l’informatique a comme préalable le cours 420-2G2-HU Programmation\norientée objet et il est préalable au cours 420-4P1-HU Développement d’applications mobiles</p>",
                'info_suppl' => "",
            ],
            [
                //ATTITUDES
                'plan_cadre_id' => 3,
                'section_id' => 13,
                'text' => '<p>Rigueur, autonomie, soucis d\'efficacité et de concision</p>',
                'info_suppl' => "",
            ],


            //Projet synthèse
            [
                //INTENTIONS ÉDUCATIVES
                'plan_cadre_id' => 4,
                'section_id' => 10,
                'texte' => "<p>Les intentions éducatives en formation spécifique s’appuient sur des valeurs et préoccupations importantes et qui servent de guide aux interventions auprès de l’étudiante ou de l’étudiant. Elles touchent généralement des dimensions significatives du développement professionnel et personnel qui n’ont pas fait l’objet de formulations explicites au niveau des buts de la formation ou des objectifs et standards. Elles peuvent porter sur des attitudes importantes, des habitudes de travail, des habiletés intellectuelles, etc.\nEn conformité avec les visées de la formation collégiale, la formation spécifique vise aussi à former la personne à vivre en société de façon responsable, à amener la personne à intégrer les acquis de la culture et, enfin, à amener la personne à maîtriser la langue comme outil de pensée, de communication et d’ouverture sur le monde.\nPour le programme Techniques de l’informatique, les intentions éducatives en formation spécifique sont les suivantes :\n•\tdévelopper l’autonomie et favoriser la polyvalence;\n•\tdévelopper le sens de l’abstraction;\n•\tpromouvoir les valeurs d’équité en matière d’accès aux technologies informatiques.\n</p>",
                'info_suppl' => "pages 7 et 8 du devis de 2017"
            ],
            [
                //Compétences
                'plan_cadre_id' => 4,
                'section_id' => 9,
                'texte' => '',
                'info_suppl' => "",
            ],
            [
                //INTENTIONS PÉDAGOGIQUES
                'plan_cadre_id' => 4,
                'section_id' => 11,
                'texte' => "<p>Ce cours de la 5e session est un préalable absolu au long stage de la session 6 : 420-6P0-HU Stage en programmation et sécurité.  C’est le 3e et dernier cours pour le développement de la compétence 00SS. Le 1er était à la session 3 : 420-3P1-HU Développement d’applications Windows. </p>",
                'info_suppl' => "",
            ],
            [
                //DESCRIPTION DU COURS
                'plan_cadre_id' => 4,
                'section_id' => 12,
                'texte' => "<p>Dans ce cours, l'étudiante ou l'étudiant poursuivra son apprentissage, amorcé dans les cours 420-3P1HU Développement d'application Windows et 420-4P1-HU Développement d'application mobiles, afin de réaliser une application intégrant une base de données.  L’étudiante ou l’étudiant produira l’application depuis un document de conception fourni jusqu'au déploiement de celle-ci en s'assurant du respect du processus complet de réalisation, incluant les tests unitaires et la documentation.</p>",
                'info_suppl' => "",
            ],
            [
                //ATTITUDES
                'plan_cadre_id' => 4,
                'section_id' => 13,
                'text' => '<p>Capacité à travailler en équipe et organisation du travail.</p>',
                'info_suppl' => "",
            ],




            //Conception de logiciel
            [
                //INTENTIONS ÉDUCATIVES
                'plan_cadre_id' => 5,
                'section_id' => 10,
                'texte' => "<p>Durant ce cours, les étudiantes et les étudiants apprendront à concevoir et modéliser des applications répondant aux besoins du client. Elles et ils développeront leurs stratégies de communication et d'organisation du travail. À la fin de ce cours, les étudiantes et les étudiants seront capables de participer à la conception d'applications en donnant des avis pertinents sur les différentes facettes du développement de la solution informatique, dont les mesures de sécurité à mettre en place. Elles et ils seront capables de faire une analyse juste des exigences du client et de produire des documents de conception de qualité, comprenant la modélisation adéquate de la base de données et de la logique applicative.</p>",
                'info_suppl' => "pages 7 et 8 du devis de 2017"
            ],
            [
                //Compétences
                'plan_cadre_id' => 5,
                'section_id' => 9,
                'texte' => '',
                'info_suppl' => "",
            ],
            [
                //INTENTIONS PÉDAGOGIQUES
                'plan_cadre_id' => 5,
                'section_id' => 11,
                'texte' => "<p>Dans ce cours l'étudiante ou l'étudiant apprendra à réaliser une application Windows\nrépondant aux caractéristiques et besoins des utilisateurs visés, en intégrant une base de\ndonnées à partir d'un document de conception fourni. Elle ou il sera en mesure de fournir un\nplan de tests pour l'application, de procéder à son déploiement et de fournir une\ndocumentation adéquate.</p>",
                'info_suppl' => "",
            ],
            [
                //DESCRIPTION DU COURS
                'plan_cadre_id' => 5,
                'section_id' => 12,
                'texte' => "<p>La conception de logiciel met en œuvre un ensemble d'activités qui, à partir d'une demande d'informatisation d'un processus, permet la conception, l'écriture et la mise au point d'un logiciel jusqu'à sa livraison au client. \nEn règle générale, la fabrication d'un logiciel va suivre trois grandes phases : \n-	Phase d'analyse (fonctionnelle) et de conception \nDurant cette phase, on effectue simultanément l'étude des données et l'étude des traitements à effectuer. C'est en général dans cette phase que s'appliquent les techniques de modélisation. Il en découle les maquettes de l’interface, la description des bases de données éventuelles à créer, les programmes à écrire et la manière dont tout cela va être intégré. \nLe présent cours s’intéresse particulièrement à cette phase. \n-	Phase de réalisation ou de programmation (développement et tests des programmes) \nCette phase permet de transformer les résultats de la phase précédente en code opérationnel. L’ensemble de cette phase comprend les algorithmes, la programmation, la gestion des versions, les tests unitaire, l’optimisation du code et la documentation du logiciel. \nLe cours Projet synthèse met en œuvre cette phase. \n-	Phase de livraison, validation et exploitation</p>",
                'info_suppl' => "",
            ],
            [
                //ATTITUDES
                'plan_cadre_id' => 5,
                'section_id' => 13,
                'text' => '<p>Rigueur, autonomie, soucis d\'efficacité et de concision</p>',
                'info_suppl' => "",
            ],

        ]);
    }
}
