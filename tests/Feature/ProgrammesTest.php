<?php

namespace Tests\Feature;

use App\Models\Competence;
use App\Models\Programme;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Testing\Fluent\AssertableJson;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ProgrammesTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp(): void
    {
        //Methode de setup pour se faire passer pour un usager avec Sanctum
        parent::setUp();
        $user = User::factory()->create();
        Sanctum::actingAs($user);
    }

    //Test qui verifie si on peut creer un nouveau programme (store)
    public function test_creer_programme(): void
    {
        $response = $this->postJson('/api/programmes',
            [
                'code' => '420.P0',
                'titre' => 'Programmation et sécurité'

            ]
        );

        $response
            //Verification du code retourné
            ->assertStatus(201)
            //Verification du retour du data et qu'il n'y a pas de message d'erreur
            ->assertJson(fn (AssertableJson $json) => $json->has('data') && $json->missing('errors'));
    }

    //Test qui verifie si on peut creer un nouveau programme sans donner un titre
    public function test_creer_programme_sans_titre_erreur_422(): void
    {
        $response = $this->postJson('/api/programmes',
            [
                "code" => "100.A0",
            ]
        );

        $response
            //Verification du code retourné --> 422 Unprocessable Entity
            ->assertStatus(422)
            //Verification du retour d'un message d'erreur
            ->assertJson([
                'message' => 'The titre field is required.',
                'errors' => ['titre' => ['The titre field is required.']],
            ]);
    }

    //Test qui verifie si ont peut afficher un programme crée (store)
    public function test_afficher_programme(): void
    {
        $programme = Programme::factory()->create();

        $response = $this->get("/api/programmes/{$programme->id}");

        $response
            //Verification du code retourné
            ->assertStatus(201)
            //Verification du retour du data et qu'il n'y a pas de message d'erreur
            ->assertJson(fn (AssertableJson $json) => $json->has('data') && $json->missing('errors'));
    }

    //Test qui verifie si ont peut mettre à jour un programme crée (update)
    public function test_mettre_a_jour_programme(): void
    {
        $programme = Programme::factory()->create();

        $response = $this->put("/api/programmes/{$programme->id}", [
            "code" => "200.B0",
            "titre" => "UpdatedProgramme"
        ]);

        $response
            //Verification du code retourné
            ->assertStatus(200)
            //Verification du retour du data et qu'il n'y a pas de message d'erreur
            ->assertJson(fn (AssertableJson $json) => $json->has('data') && $json->missing('errors'));
    }

    //Test qui verifie si ont peut mettre à jour un programme crée (update)
    public function test_mettre_a_jour_programme_sans_titre_erreur_302(): void
    {
        $programme = Programme::factory()->create();

        $response = $this->put("/api/programmes/{$programme->id}", [
            "code" => "000.I0"
        ]);

        $response
            //Verification du code retourné
            ->assertStatus(302)
            //Verification du retour d'un message d'erreur
            ->assertSessionHasErrors('titre');
    }

    //Test qui verifie si ont peut supprimer un programme crée (destroy)
    public function test_supprimer_programme(): void
    {
        $programme = Programme::factory()->create();

        $response = $this->delete("/api/programmes/{$programme->id}");

        $response
            //Verification du code retourné
            ->assertStatus(201)
            //Verification du retour du data et qu'il n'y a pas de message d'erreur
            ->assertJson(fn (AssertableJson $json) => $json->has('data') && $json->missing('errors'));
    }

    //Test qui verifie si on peut dissocier une competence d<un programme
    public function test_dissocier_competences_du_programme(): void
    {
        $programme = Programme::factory()->create();
        $competences = Competence::factory()->count(3)->create(['programme_id' => $programme->id]);

        //Verifier si une competence contient un programme --> programme_id
        $this->assertDatabaseHas('competences', ['programme_id' => $programme->id]);

        //Appele de la methode dissocier_toutes_competences
        $programme->dissocier_toutes_competences();

        //Verifier si une competence ne contient plus le programme
        foreach ($competences as $competence) {
            $this->assertDatabaseMissing('competences', ['programme_id' => $programme->id]);
        }
    }
}
