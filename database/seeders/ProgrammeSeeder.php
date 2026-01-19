<?php

namespace Database\Seeders;

use App\Models\Competence;
use App\Models\Programme;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProgrammeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Programme::factory()->createOne([
            'code' => '420.B0',
            'titre' => 'Programmation et sécurité'
        ]);

        Programme::factory()->createOne([
            'code' => '200.B0',
            'titre' => 'Sciences de la nature'
        ]);
        Programme::factory()->createOne([
            'code' => '500.AG',
            'titre' => 'Art, lettres et communication'
        ]);
        Programme::factory()->createOne([
            'code' => '510.AM',
            'titre' => 'Arts visuels'
        ]);
        Programme::factory()->createOne([
            'code' => '700.A0',
            'titre' => 'Sciences, lettres et arts'
        ]);
        Programme::factory()->createOne([
            'code' => '300.M0',
            'titre' => 'Sciences humaines'
        ]);
        Programme::factory()->createOne([
            'code' => '111.A0',
            'titre' => 'Hygiène dentaire'
        ]);
        Programme::factory()->createOne([
            'code' => '142.H0',
            'titre' => 'Technologie de radiodiagnostic'
        ]);
        Programme::factory()->createOne([
            'code' => '391.A0',
            'titre' => 'Gestion et intervention en loisir'
        ]);
        Programme::factory()->createOne([
            'code' => '388.A1',
            'titre' => 'Technique en travail social'
        ]);
        Programme::factory()->createOne([
            'code' => '120.A0',
            'titre' => 'Diététique'
        ]);
        Programme::factory()->createOne([
            'code' => '140.C0',
            'titre' => 'Analyses biomédicales'
        ]);
        Programme::factory()->createOne([
            'code' => '141.A0',
            'titre' => 'Inhalothérapie'
        ]);
        Programme::factory()->createOne([
            'code' => '180.A0',
            'titre' => 'Soins infirmiers'
        ]);
        Programme::factory()->createOne([
            'code' => '181.A0',
            'titre' => 'Soins préhospitaliers d\'urgence'
        ]);
        Programme::factory()->createOne([
            'code' => '310.A0',
            'titre' => 'Techniques policières'
        ]);
        Programme::factory()->createOne([
            'code' => '310.C0',
            'titre' => 'Techniques juridiques'
        ]);
        Programme::factory()->createOne([
            'code' => '322.A0',
            'titre' => 'Éducation à l\'enfance'
        ]);
        Programme::factory()->createOne([
            'code' => '351.A0',
            'titre' => 'Éducation spécialisée'
        ]);
        Programme::factory()->createOne([
            'code' => '393.B0',
            'titre' => 'Documentation, gestion de l\'information et des archives'
        ]);
        Programme::factory()->createOne([
            'code' => '210.AA',
            'titre' => 'Biotechnologie, techniques de laboratoire'
        ]);
        Programme::factory()->createOne([
            'code' => '221.A0',
            'titre' => 'Architecture'
        ]);
        Programme::factory()->createOne([
            'code' => '221.B0',
            'titre' => 'Génie civil'
        ]);
        Programme::factory()->createOne([
            'code' => '221.C0',
            'titre' => 'Génie du bâtiment'
        ]);
        Programme::factory()->createOne([
            'code' => '230.AA',
            'titre' => 'Géomatique, spécialisation en cartographie'
        ]);
        Programme::factory()->createOne([
            'code' => '241.A0',
            'titre' => 'Génie mécanique'
        ]);
        Programme::factory()->createOne([
            'code' => '243.A0',
            'titre' => 'Génie de l\'électronique programmable'
        ]);
        Programme::factory()->createOne([
            'code' => '410.B0',
            'titre' => 'Comptabilité et gestion'
        ]);
        Programme::factory()->createOne([
            'code' => '410.D0',
            'titre' => 'Gestion de commerce'
        ]);
        Programme::factory()->createOne([
            'code' => '412.AA',
            'titre' => 'Gestion du travail administratif (Techniques de bureautique)'
        ]);
        Programme::factory()->createOne([
            'code' => '420.B0',
            'titre' => 'Réseaux et cybersécurité'
        ]);
        Programme::factory()->createOne([
            'code' => '570.E0',
            'titre' => 'Design d\'intérieur'
        ]);
        Programme::factory()->createOne([
            'code' => '582.A1',
            'titre' => 'Intégration multimédia'
        ]);
    }
}
