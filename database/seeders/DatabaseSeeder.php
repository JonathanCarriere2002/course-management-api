<?php

namespace Database\Seeders;

use App\Models\Competence;
use App\Models\CriterePerformance;
use App\Models\ElementCompetence;
use Illuminate\Database\Seeder;

/**
 * Classe permettant d'insérer les données initiales dans la base de données
 */
class DatabaseSeeder extends Seeder
{
    /**
     * Insérer les données initiales dans la base de données
     * @return void
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            ProgrammeSeeder::class,
            UserSeeder::class,
            CompetenceSeeder::class,
            ElementCompetenceSeeder::class,
            CriterePerformanceSeeder::class,
            SessionSeeder::class,
            TypeSectionSeeder::class,
            SectionSeeder::class,
            GabaritSeeder::class,
            PlanCadreSeeder::class,
            CampusSeeder::class,
            EnseignantSeeder::class,
            PlanCoursSeeder::class,
            EnseignantPlanCoursSeeder::class,
            PlanCoursSectionSeeder::class,
            GabaritSectionSeeder::class,
            SemaineCoursSeeder::class,
            PlanCadreSectionSeeder::class
        ]);
    }

}
