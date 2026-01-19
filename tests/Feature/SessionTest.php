<?php

namespace Tests\Feature;

use App\Models\Session;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

/**
 * Tests unitaires associés aux sessions
 * @author Jonathan Carrière
 */
class SessionTest extends TestCase
{
    // Configuration pour la base de données
    use DatabaseTransactions;

    // Session utilisée dans les tests unitaires
    private Session $session;

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
        // Création d'une session
        $this->session = Session::factory()->createOne();
    }

    /**
     * Test unitaire permettant de valider que l'index pour les sessions est fonctionnelle
     */
    public function testIndex(): void
    {
        // Vérifier que la page contenant la liste des sessions s'affiche
        $reponse = $this->getJson("/api/sessions");
        $reponse->assertStatus(201);
    }

    /**
     * Test unitaire permettant de valider qu'afficher une session est fonctionnelle
     */
    public function testShow(): void
    {
        // Vérifier que la page contenant les détails d'une session s'affiche
        $reponse = $this->getJson("/api/sessions/{$this->session->id}");
        $reponse->assertStatus(201);
    }

    /**
     * Test unitaire permettant de valider qu'ajouter une session est fonctionnelle
     */
    public function testStore(): void
    {
        // Vérifier que la session n'existe pas dans la base de données
        $this->assertDatabaseMissing("sessions", [
            "session" => "Automne",
            "annee" => "2032",
            "limite_abandon" => "2032-09-01"
        ]);
        // Insérer la session dans la base de données via une requête POST
        $reponse = $this->postJson("/api/sessions", [
            "session" => "Automne",
            "annee" => "2032",
            "limite_abandon" => "2032-09-01"
        ]);
        // Vérifier que la requête à fonctionner
        $reponse->assertStatus(201);
        // Vérifier que la base de données contient la nouvelle session
        $this->assertDatabaseHas("sessions", [
            "session" => "Automne",
            "annee" => "2032",
            "limite_abandon" => "2032-09-01"
        ]);
    }

    /**
     * Test unitaire permettant de valider que modifier une session est fonctionnelle
     */
    public function testUpdate(): void
    {
        // Modifier la session dans la base de données via une requête PUT
        $reponse = $this->putJson("/api/sessions/{$this->session->id}", [
            "session" => "Automne",
            "annee" => "2032",
            "limite_abandon" => "2032-09-01"
        ]);
        // Vérifier que la requête à fonctionner
        $reponse->assertStatus(201);
        // Vérifier que la base de données contient la session modifiée
        $this->assertDatabaseHas("sessions", [
            "session" => "Automne",
            "annee" => "2032",
            "limite_abandon" => "2032-09-01"
        ]);
    }

    /**
     * Test unitaire permettant de valider que supprimer une session est fonctionnelle
     */
    public function testDestroy(): void
    {
        // Supprimer la session dans la base de données via une requête DELETE
        $reponse = $this->deleteJson("/api/sessions/{$this->session->id}");
        // Vérifier que la requête à fonctionner
        $reponse->assertStatus(201);
        // Vérifier que la base de données ne contient pas la session supprimée
        $this->assertDatabaseMissing("sessions", [
            "id" => $this->session->id,
            "session" => $this->session->session,
            "annee" => $this->session->annee,
            "limite_abandon" => $this->session->limite_abandon
        ]);
    }

}
