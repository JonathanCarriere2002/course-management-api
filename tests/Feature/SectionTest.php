<?php

/**
 * @author Emeric Chauret
 */

use App\Models\Section;
use App\Models\TypeSection;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Testing\Fluent\AssertableJson;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class SectionTest extends TestCase
{
    use DatabaseTransactions;

    private Section $section;

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
        $this->section = Section::factory()->createOne(); // créer une section à utiliser pour les tests
    }

    /**
     * Tester la route pour afficher la liste des sections.
     * @return void
     */
    public function test_index_existe(): void
    {
        $reponse = $this->getJson("/api/sections");
        $reponse->assertStatus(200);
    }

    /**
     * Tester la route pour afficher une section.
     * @return void
     */
    public function test_show_existe(): void
    {
        $reponse = $this->getJson("/api/sections/{$this->section->id}");
        $reponse->assertStatus(200);
    }

    /**
     * Tester que la propriété titre de la section est retourné à la vue.
     * @return void
     */
    public function test_show_affiche_titre_section(): void
    {
        $reponse = $this->getJson("/api/sections/{$this->section->id}");
        $reponse->assertJson(fn (AssertableJson $json) => $json->has("data"));
        $reponse->assertSee($this->section->titre);
    }

    /**
     * Tester la création d'une section avec des données valides.
     * @return void
     */
    public function test_creer_donnees_valides() : void
    {
        $type_section = TypeSection::factory()->createOne();
        $this->assertDatabaseMissing("sections", [
            "titre" => "section test",
            "aide" => "Ceci est un test.",
            "obligatoire" => true,
            "type_section_id" => $type_section->id
        ]);
        $reponse = $this->postJson("/api/sections", [
            "titre" => "section test",
            "aide" => "Ceci est un test.",
            "obligatoire" => true,
            "type_section_id" => $type_section->id
        ]);
        $reponse->assertStatus(201);
        $this->assertDatabaseHas("sections", [
            "titre" => "section test",
            "aide" => "Ceci est un test.",
            "obligatoire" => true,
            "type_section_id" => $type_section->id
        ]);
    }

    /**
     * Tester la modification d'une sections avec des données valides.
     * @return void
     */
    public function test_modif_donnees_valides() : void
    {
        $reponse = $this->putJson("/api/sections/{$this->section->id}", [
            "titre" => "section test",
            "aide" => "aide",
            "obligatoire" => false,
            "type_section_id" => $this->section->type_section_id
        ]);
        $reponse->assertStatus(200);
        $this->assertDatabaseHas("sections", [
            "titre" => "section test",
            "aide" => "aide",
            "obligatoire" => false,
            "type_section_id" => $this->section->type_section_id
        ]);
    }

    /**
     * Tester la suppression d'une section.
     * @return void
     */
    public function test_supprimer() : void
    {
        $reponse = $this->deleteJson("/api/sections/{$this->section->id}");
        $reponse->assertStatus(200);
        $this->assertDatabaseMissing("sections", [
            "id" => $this->section->id,
            "titre" => $this->section->titre,
            "aide" => $this->section->aide,
            "obligatoire" => $this->section->obligatoire
        ]);
    }
}
