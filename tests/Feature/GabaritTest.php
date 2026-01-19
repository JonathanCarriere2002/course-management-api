<?php

/**
 * @author Emeric Chauret
 */

use App\Models\Gabarit;
use App\Models\Section;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Testing\Fluent\AssertableJson;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class GabaritTest extends TestCase
{
    use DatabaseTransactions;

    private Gabarit $gabarit;

    /**
     * Méthode qui s'exécute avant chaque test
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $user = User::factory()->createOne([
            "role" => 1 // role admin
        ]); // créer un utilisateur à utiliser pour les tests
        Sanctum::actingAs($user); // simuler l'authentification de l'utilisateur
        $this->gabarit = Gabarit::factory()->createOne(); // créer un gabarit à utiliser pour les tests
    }

    /**
     * Tester la route pour afficher la liste des gabarits.
     * @return void
     */
    public function test_index_existe(): void
    {
        $reponse = $this->getJson("/api/gabarits");
        $reponse->assertStatus(200);
    }

    /**
     * Tester la route pour afficher un gabarit.
     * @return void
     */
    public function test_show_existe(): void
    {
        $reponse = $this->getJson("/api/gabarits/{$this->gabarit->id}");
        $reponse->assertStatus(200);
    }

    /**
     * Tester que la propriété nom du gabarit est retourné à la vue.
     * @return void
     */
    public function test_show_affiche_nom_gabarit(): void
    {
        $reponse = $this->getJson("/api/gabarits/{$this->gabarit->id}");
        $reponse->assertJson(fn (AssertableJson $json) => $json->has("data"));
        $reponse->assertSee($this->gabarit->nom);
    }

    /**
     * Tester la création d'un gabarit avec des données valides.
     * @return void
     */
    public function test_creer_donnees_valides() : void
    {
        $section1 = Section::factory()->createOne();
        $section2 = Section::factory()->createOne();
        $this->assertDatabaseMissing("gabarits", [
            "nom" => "gabarit test"
        ]);
        $reponse = $this->postJson("/api/gabarits", [
            "nom" => "gabarit test",
            "sections" => [
                [
                    "id" => $section1->id
                ],
                [
                    "id" => $section2->id
                ]
            ]
        ]);
        $reponse->assertStatus(201);
        $this->assertDatabaseHas("gabarits", [
            "nom" => "gabarit test"
        ]);
    }

    /**
     * Tester la modification d'un gabarit avec des données valides.
     * @return void
     */
    public function test_modif_donnees_valides() : void
    {
        $reponse = $this->putJson("/api/gabarits/{$this->gabarit->id}", [
            "nom" => "gabarit test",
            "sections" => $this->gabarit->sections
        ]);
        $reponse->assertStatus(200);
        $this->assertDatabaseHas("gabarits", [
            "id" => $this->gabarit->id,
            "nom" => "gabarit test"
        ]);
    }

    /**
     * Tester la suppression d'un gabarit.
     * @return void
     */
    public function test_supprimer() : void
    {
        $reponse = $this->deleteJson("/api/gabarits/{$this->gabarit->id}");
        $reponse->assertStatus(200);
        $this->assertDatabaseMissing("gabarits", [
            "id" => $this->gabarit->id,
            "nom" => $this->gabarit->nom
        ]);
    }
}
