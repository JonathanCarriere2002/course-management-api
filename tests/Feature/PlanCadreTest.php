<?php

namespace Tests\Feature;

use App\Models\Gabarit;
use App\Models\PlanCadre;
use App\Models\Session;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class PlanCadreTest extends TestCase
{

    // Configuration pour la base de données
    use DatabaseTransactions;

    // Session utilisée dans les tests unitaires
    private PlanCadre $planCadre;
    private Gabarit $gabarit_plan_cadre;

    public function setUp(): void
    {
        parent::setUp();
        // Création d'un utilisateur admin via le factory
        $user = User::factory()->createOne([
            'role'=>1 // Role administrateur
        ]);
        // Effectuer l'authentification de l'utilisateur
        Sanctum::actingAs($user);
        // Récupérer un plan-cadre
        $this->planCadre = PlanCadre::find(1);

        // Récupérer le gabarit pour les plans de cours
        $this->gabarit_plan_cadre = Gabarit::find(2);

        //Associer le gabarit au plan-cadre
        $this->planCadre->associer_gabarit($this->gabarit_plan_cadre->id);


    }


    /**
     * Test unitaire permettant de valider qu'afficher une session est fonctionnelle
     */
    public function testShow(): void
    {
        // Vérifier que la page contenant les détails d'une session s'affiche
        $reponse = $this->getJson("/api/plans-cadres/{$this->planCadre->id}");
        $reponse->assertStatus(200);
    }
}
