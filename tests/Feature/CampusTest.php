<?php

/**
 * @author Emeric Chauret
 */

use App\Models\Campus;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Testing\Fluent\AssertableJson;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class CampusTest extends TestCase
{
    use DatabaseTransactions;

    private Campus $campus;

    /**
     * Méthode qui s'exécute avant chaque test
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $user = User::factory()->createOne(); // créer un utilisateur à utiliser pour les tests
        Sanctum::actingAs($user); // simuler l'authentification de l'utilisateur
        $this->campus = Campus::factory()->createOne(); // créer un campus à utiliser pour les tests
    }

    /**
     * Tester la route pour afficher la liste des campus.
     * @return void
     */
    public function test_index_existe(): void
    {
        $reponse = $this->getJson("/api/campus");
        $reponse->assertStatus(200);
    }

    /**
     * Tester la route pour afficher un campus.
     * @return void
     */
    public function test_show_existe(): void
    {
        $reponse = $this->getJson("/api/campus/{$this->campus->id}");
        $reponse->assertStatus(200);
    }

    /**
     * Tester que la propriété nom du campus est retourné à la vue.
     * @return void
     */
    public function test_show_affiche_nom_campus(): void
    {
        $reponse = $this->getJson("/api/campus/{$this->campus->id}");
        $reponse->assertJson(fn (AssertableJson $json) => $json->has("data"));
        $reponse->assertSee($this->campus->nom);
    }

    /**
     * Tester la création d'un campus avec des données valides.
     * @return void
     */
    public function test_creer_donnees_valides() : void
    {
        $this->assertDatabaseMissing("campuses", [
            "nom" => "campus test"
        ]);
        $reponse = $this->postJson("/api/campus", [
            "nom" => "campus test"
        ]);
        $reponse->assertStatus(201);
        $this->assertDatabaseHas("campuses", [
            "nom" => "campus test"
        ]);
    }

    /**
     * Tester la modification d'un campus avec des données valides.
     * @return void
     */
    public function test_modif_donnees_valides() : void
    {
        $reponse = $this->putJson("/api/campus/{$this->campus->id}", [
            "nom" => "campus test"
        ]);
        $reponse->assertStatus(200);
        $this->assertDatabaseHas("campuses", [
            "id" => $this->campus->id,
            "nom" => "campus test"
        ]);
    }

    /**
     * Tester la suppression d'un campus.
     * @return void
     */
    public function test_supprimer() : void
    {
        $reponse = $this->deleteJson("/api/campus/{$this->campus->id}");
        $reponse->assertStatus(200);
        $this->assertDatabaseMissing("campuses", [
            "id" => $this->campus->id,
            "nom" => $this->campus->nom
        ]);
    }
}
