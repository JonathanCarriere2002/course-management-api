<?php

/**
 * @author Emeric Chauret
 */

use App\Models\Campus;
use App\Models\Gabarit;
use App\Models\PlanCadre;
use App\Models\PlanCours;
use App\Models\Programme;
use App\Models\Session;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Testing\Fluent\AssertableJson;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class PlanCoursTest extends TestCase
{
    use DatabaseTransactions;

    private PlanCours $plan_cours;
    private Programme $programme;
    private PlanCadre $plan_cadre;
    private Gabarit $gabarit_plan_cours;
    private User $user;

    /**
     * Méthode qui s'exécute avant chaque test
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        // Créer un utilisateur à utiliser pour les tests
        $this->user = User::factory()->createOne([
            "role" => 1 // role administrateur
        ]);
        Sanctum::actingAs($this->user); // simuler l'authentification de l'utilisateur

        // Récupérer le gabarit pour les plans de cours
        $this->gabarit_plan_cours = Gabarit::find(1);

        // Récupérer un plan de cours
        $this->plan_cours = PlanCours::find(1);

        // Récupérer le plan-cadre associé au plan de cours
        $this->plan_cadre = PlanCadre::find($this->plan_cours->plan_cadre_id);

        // Récupérer le programme associé au plan-cadre
        $this->programme = Programme::find($this->plan_cadre->programme_id);
    }

    /**
     * Tester la route pour afficher la liste des plans de cours.
     * @return void
     */
    public function test_index_existe(): void
    {
        $plans_cours = PlanCours::factory(2)->create();
        $plans_cours->map(function ($plan_cours) {
            $plan_cours->associer_plan_cadre($this->plan_cadre->id);
        });
        $reponse = $this->getJson("/api/programmes/{$this->programme->id}/plans-cours");
        $reponse->assertStatus(200);
    }

    /**
     * Tester la route pour afficher un plan de cours.
     * @return void
     */
    public function test_show_existe(): void
    {
        $reponse = $this->getJson("/api/programmes/{$this->programme->id}/plans-cours/{$this->plan_cours->id}");
        $reponse->assertStatus(200);
    }

    /**
     * Tester que la propriété nom du gabarit associé au plan de cours
     * est retourné à la vue.
     * @return void
     */
    public function test_show_affiche_nom_gabarit(): void
    {
        $reponse = $this->getJson("/api/programmes/{$this->programme->id}/plans-cours/{$this->plan_cours->id}");
        $reponse->assertJson(fn (AssertableJson $json) => $json->has('data'));
        $reponse->assertSee($this->plan_cours->gabarit->nom);
    }

    /**
     * Tester la création d'un plan de cours avec des données valides.
     * @return void
     */
    public function test_creer_donnees_valides() : void
    {
        $campus = Campus::find(2);
        $session = Session::find(2);
        $this->assertDatabaseMissing("plan_cours", [
            "gabarit_id" => $this->gabarit_plan_cours->id,
            "plan_cadre_id" => $this->plan_cadre->id,
            "campus_id" => $campus->id,
            "session_id" => $session->id
        ]);
        $reponse = $this->postJson("/api/programmes/{$this->programme->id}/plans-cours", [
            "plan_cadre" => $this->plan_cadre,
            "campus" => $campus,
            "session" => $session,
            "enseignants" => [],
            "sections" => [],
            "semaines_cours" => []
        ]);
        $reponse->assertStatus(201);
        $this->assertDatabaseHas("plan_cours", [
            "gabarit_id" => $this->gabarit_plan_cours->id,
            "plan_cadre_id" => $this->plan_cadre->id,
            "campus_id" => $campus->id,
            "session_id" => $session->id,
            "cree_par" => $this->user->id,
            "complet" => 0
        ]);
    }

    /**
     * Tester la modification d'un plan de cours avec des données valides.
     * @return void
     */
    public function test_modif_donnees_valides() : void
    {
        $campus = Campus::find(2);
        $session = Session::find(2);
        $reponse = $this->putJson("/api/programmes/{$this->programme->id}/plans-cours/{$this->plan_cours->id}", [
            "gabarit_id" => $this->gabarit_plan_cours->id,
            "plan_cadre" => $this->plan_cours->plan_cadre,
            "campus" => $campus,
            "session" => $session,
            "enseignants" => [],
            "sections" => [],
            "semaines_cours" => []
        ]);
        $reponse->assertStatus(200);
        $this->assertDatabaseHas("plan_cours", [
            "id" => $this->plan_cours->id,
            "gabarit_id" => $this->plan_cours->gabarit->id,
            "plan_cadre_id" => $this->plan_cours->plan_cadre->id,
            "campus_id" => $campus->id,
            "session_id" => $session->id,
            "cree_par" => $this->plan_cours->cree_par,
            "complet" => 0
        ]);
    }

    /**
     * Tester la suppression d'un plan de cours.
     * @return void
     */
    public function test_supprimer() : void
    {
        $reponse = $this->deleteJson("/api/programmes/{$this->programme->id}/plans-cours/{$this->plan_cours->id}");
        $reponse->assertStatus(200);
        $this->assertDatabaseMissing("plan_cours", [
            "id" => $this->plan_cours->id,
            "gabarit_id" => $this->plan_cours->gabarit->id,
            "plan_cadre_id" => $this->plan_cours->plan_cadre->id,
            "campus_id" => $this->plan_cours->campus->id,
            "session_id" => $this->plan_cours->session->id,
            "cree_par" => $this->plan_cours->cree_par,
            "complet" => $this->plan_cours->complet
        ]);
    }

}
