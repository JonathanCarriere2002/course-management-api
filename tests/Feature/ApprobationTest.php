<?php

namespace Tests\Feature;

use App\Models\PlanCadre;
use App\Models\PlanCours;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

/**
 * Tests unitaires associés à l'approbation des plans-cadres et plans de cours
 * @author Jonathan Carrière
 */
class ApprobationTest extends TestCase
{
    // Configuration pour la base de données
    use DatabaseTransactions;

    // Plan-cadre utilisé dans les tests unitaires
    private PlanCadre $planCadre;

    // Plan de cours utilisé dans les tests unitaires
    private PlanCours $planCours;

    /**
     * Méthode permettant d'effectuer la configuration des tests
     */
    public function setUp(): void
    {
        parent::setUp();
        // Création d'un utilisateur via le factory
        $user = User::factory()->createOne();
        // Effectuer l'authentification de l'utilisateur
        Sanctum::actingAs($user);
        // Création d'un plan-cadre
        $this->planCadre = PlanCadre::factory()->createOne();
        // Création d'un plan de cours
        $this->planCours = PlanCours::factory()->createOne();
    }

    /**
     * Test unitaire permettant de valider que l'approbation d'un plan de cours fonctionne
     */
    public function testePlanCoursApprobation(): void
    {

        // Modifier la date d'approbation du plan de cours via une requête PATCH
        $reponse = $this->patchJson("/api/plans-cours/approbation/{$this->planCours->id}/2002-12-31");
        // Vérifier que la requête à fonctionner
        $reponse->assertStatus(201);
        // Vérifier que la base de données contient la bonne date d'approbation pour le plan de cours
        $this->assertDatabaseHas("plan_cours", [
            "id" => $this->planCours->id,
            "approbation" => '2002-12-31'
        ]);

        // Supprimer la date d'approbation du plan de cours via une requête PATCH
        $reponse = $this->patchJson("/api/plans-cours/approbation-supprimer/{$this->planCours->id}");
        // Vérifier que la requête à fonctionner
        $reponse->assertStatus(201);
        // Vérifier que la base de données ne contient pas la date d'approbation pour le plan de cours
        $this->assertDatabaseHas("plan_cours", [
            "id" => $this->planCours->id,
            "approbation" => null
        ]);

    }

    /**
     * Test unitaire permettant de valider que l'approbation d'un plan-cadre fonctionne
     */
    public function testPlanCadreApprobation(): void
    {

        // Modifier la date d'approbation du plan-cadre par le département via une requête PATCH et vérifier que la requête à fonctionner
        $reponse = $this->patchJson("/api/plans-cadres/approbation/{$this->planCadre->id}/2002-12-31/departement");
        $reponse->assertStatus(201);
        // Modifier la date d'approbation du plan-cadre par le comité de programme via une requête PATCH et vérifier que la requête à fonctionner
        $reponse = $this->patchJson("/api/plans-cadres/approbation/{$this->planCadre->id}/2003-1-1/comite");
        $reponse->assertStatus(201);
        // Modifier la date d'approbation du plan-cadre par la direction des études via une requête PATCH et vérifier que la requête à fonctionner
        $reponse = $this->patchJson("/api/plans-cadres/approbation/{$this->planCadre->id}/2003-1-5/direction");
        $reponse->assertStatus(201);
        // Vérifier que la base de données contient les bonnes dates d'approbation pour le plan-cadre
        $this->assertDatabaseHas("plans_cadres", [
            "id" => $this->planCadre->id,
            "dateApprobationDepartement" => '2002-12-31',
            "dateApprobationComiteProgrammes" => '2003-1-1',
            "dateDepotDirectionEtudes" => '2003-1-5'
        ]);

        // Supprimer la date d'approbation du plan-cadre par la direction des études via une requête PATCH et vérifier que la requête à fonctionner
        $reponse = $this->patchJson("/api/plans-cadres/approbation-supprimer/{$this->planCadre->id}/direction");
        $reponse->assertStatus(201);
        // Supprimer la date d'approbation du plan-cadre par le comité de programme via une requête PATCH et vérifier que la requête à fonctionner
        $reponse = $this->patchJson("/api/plans-cadres/approbation-supprimer/{$this->planCadre->id}/comite");
        $reponse->assertStatus(201);
        // Supprimer la date d'approbation du plan-cadre par le département via une requête PATCH et vérifier que la requête à fonctionner
        $reponse = $this->patchJson("/api/plans-cadres/approbation-supprimer/{$this->planCadre->id}/departement");
        $reponse->assertStatus(201);
        // Vérifier que la base de données contient les bonnes dates d'approbation pour le plan-cadre
        $this->assertDatabaseHas("plans_cadres", [
            "id" => $this->planCadre->id,
            "dateApprobationDepartement" => null,
            "dateApprobationComiteProgrammes" => null,
            "dateDepotDirectionEtudes" => null
        ]);

    }

}
