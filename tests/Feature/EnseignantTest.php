<?php

namespace Tests\Feature;

use App\Models\Enseignant;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

/**
 * Tests unitaires associés aux enseignants
 * @author Jonathan Carrière
 */
class EnseignantTest extends TestCase
{
    // Configuration pour la base de données
    use DatabaseTransactions;

    // Enseignant utilisé dans les tests unitaires
    private Enseignant $enseignant;

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
        // Création d'un enseignant
        $this->enseignant = Enseignant::factory()->createOne();
    }

    /**
     * Test unitaire permettant de valider que l'index pour les enseignants est fonctionnelle
     */
    public function testIndex(): void
    {
        // Vérifier que la page contenant la liste des enseignants s'affiche
        $reponse = $this->getJson("/api/enseignants");
        $reponse->assertStatus(201);
    }

    /**
     * Test unitaire permettant de valider qu'afficher un enseignant est fonctionnelle
     */
    public function testShow(): void
    {
        // Vérifier que la page contenant les détails d'un enseignant s'affiche
        $reponse = $this->getJson("/api/enseignants/{$this->enseignant->id}");
        $reponse->assertStatus(201);
    }

    /**
     * Test unitaire permettant de valider qu'ajouter un enseignant est fonctionnelle
     */
    public function testStore(): void
    {
        // Vérifier que l'enseignant n'existe pas dans la base de données
        $this->assertDatabaseMissing("enseignants", [
            "prenom" => "Jonathan",
            "nom" => "Carrière",
            "courriel" => "jonathan@cegepoutaouais.qc.ca",
            "bureau" => "1.063",
        ]);
        // Insérer l'enseignant dans la base de données via une requête POST
        $reponse = $this->postJson("/api/enseignants", [
            "prenom" => "Jonathan",
            "nom" => "Carrière",
            "courriel" => "jonathan@cegepoutaouais.qc.ca",
            "bureau" => "1.063",
            "programmes" => []
        ]);
        // Vérifier que la requête à fonctionner
        $reponse->assertStatus(201);
        // Vérifier que la base de données contient le nouvel enseignant
        $this->assertDatabaseHas("enseignants", [
            "prenom" => "Jonathan",
            "nom" => "Carrière",
            "courriel" => "jonathan@cegepoutaouais.qc.ca",
            "bureau" => "1.063"
        ]);
    }

    /**
     * Test unitaire permettant de valider que modifier un enseignant est fonctionnelle
     */
    public function testUpdate(): void
    {
        // Modifier l'enseignant dans la base de données via une requête PUT
        $reponse = $this->putJson("/api/enseignants/{$this->enseignant->id}", [
            "prenom" => "Jonathan",
            "nom" => "Carrière",
            "courriel" => "jonathan@cegepoutaouais.qc.ca",
            "bureau" => "1.063",
            "poste" => 2002,
            "programmes" => []
        ]);
        // Vérifier que la requête à fonctionner
        $reponse->assertStatus(201);
        // Vérifier que la base de données contient l'enseignant modifié
        $this->assertDatabaseHas("enseignants", [
            "prenom" => "Jonathan",
            "nom" => "Carrière",
            "courriel" => "jonathan@cegepoutaouais.qc.ca",
            "bureau" => "1.063",
            "poste" => 2002
        ]);
    }

    /**
     * Test unitaire permettant de valider que supprimer un enseignant est fonctionnelle
     */
    public function testDestroy(): void
    {
        // Supprimer l'enseignant dans la base de données via une requête DELETE
        $reponse = $this->deleteJson("/api/enseignants/{$this->enseignant->id}");
        // Vérifier que la requête à fonctionner
        $reponse->assertStatus(201);
        // Vérifier que la base de données ne contient pas l'enseignant supprimé
        $this->assertDatabaseMissing("enseignants", [
            "id" => $this->enseignant->id,
            "prenom" => $this->enseignant->prenom,
            "nom" => $this->enseignant->nom,
            "courriel" => $this->enseignant->courriel,
            "bureau" => $this->enseignant->bureau,
            "poste" => $this->enseignant->poste
        ]);
    }

}
