<?php
/* @author lebel */
namespace Tests\Feature;

use App\Models\Competence;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class CompetencesTest extends TestCase
{
    use DatabaseTransactions;

    private Competence $competence;

    /**
     * Méthode qui s'exécute avant chaque test
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $user = User::factory()->createOne(); // créer un user pour qu'il execute les test
        Sanctum::actingAs($user); // simuler l'authentification de l'utilisateur
        $this->competence = Competence::factory()->createOne(); // créer une competence test
    }

    /**
     * Test pour s'assurer que l'index fonctionne
     * @return void
     */
    public function test_index_existe(): void
    {
        $reponse = $this->getJson("/api/competences");
        $reponse->assertStatus(200);
    }

    /**
     * Test pour s'assurer que la suppression fonctionne
     * @return void
     */
    public function test_supprimer() : void
    {
        $reponse = $this->deleteJson("/api/competences/{$this->competence->id}");
        $reponse->assertStatus(200);
        $this->assertDatabaseMissing("competences", [
            "id" => $this->competence->id,
            "code" => $this->competence->code,
            "enonce" => $this->competence->enonce,
            "annee_devis" => $this->competence->annee_devis,
            "pages_devis" => $this->competence->pages_devis,
            "contexte" => $this->competence->contexte,
            "programme_id" => $this->competence->programme_id
        ]);
    }
}
