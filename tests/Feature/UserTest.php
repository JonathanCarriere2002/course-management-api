<?php

namespace Tests\Feature;

use App\Models\User;
use DateTime;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

/**
 * Tests unitaires associés aux utilisateurs
 * @author Jonathan Carrière
 */
class UserTest extends TestCase
{
    // Configuration pour la base de données
    use DatabaseTransactions;

    // Utilisateur utilisé dans les tests unitaires
    private User $utilisateur;

    // Temps utilisé pour vérifier le  courriel de l'utilisateurs
    private DateTime $tempsCourriel;

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
        // Création d'un utilisateur
        $this->utilisateur = User::factory()->createOne();
        // Définir le temps de vérification du courriel de l'utilisateur
        $this->tempsCourriel = now();
    }

    /**
     * Test unitaire permettant de valider que l'index pour les utilisateurs est fonctionnelle
     */
    public function testIndex(): void
    {
        // Vérifier que la page contenant la liste des utilisateurs s'affiche
        $reponse = $this->getJson("/api/utilisateurs");
        $reponse->assertStatus(201);
    }

    /**
     * Test unitaire permettant de valider qu'afficher un utilisateur est fonctionnelle
     */
    public function testShow(): void
    {
        // Vérifier que la page contenant les détails d'un utilisateur s'affiche
        $reponse = $this->getJson("/api/utilisateurs/{$this->utilisateur->id}");
        $reponse->assertStatus(201);
    }

    /**
     * Test unitaire permettant de valider qu'ajouter un utilisateur valide est fonctionnelle
     */
    public function testStoreValide(): void
    {
        // Vérifier que l'utilisateur n'existe pas dans la base de données
        $this->assertDatabaseMissing("users", [
            'name' => 'Carrière',
            'firstname' => 'Jonathan',
            'email' => 'jonathan@email.qc.ca',
            'email_verified_at' => $this->tempsCourriel,
            'password' => 'password123!',
            'role' => 1
        ]);
        // Insérer l'utilisateur dans la base de données via une requête POST
        $motDePasse = 'password123!';
        $reponse = $this->postJson("/api/utilisateurs", [
            'nom' => 'Carrière',
            'prenom' => 'Jonathan',
            'courriel' => 'jonathan@email.qc.ca',
            'mot_de_passe' => $motDePasse,
            'mot_de_passe_confirmation' => $motDePasse,
            'role' => 1
        ]);
        // Vérifier que la requête à fonctionner
        $reponse->assertStatus(201);
        // Vérifier que la base de données contient le nouvel utilisateur
        $this->assertDatabaseHas("users", [
            'name' => 'Carrière',
            'firstname' => 'Jonathan',
            'email' => 'jonathan@email.qc.ca',
            'email_verified_at' => $this->tempsCourriel,
            'role' => 1
        ]);
        // Vérifier que le mot de passe a correctement été haché puis insérer dans la base de données
        // Source : https://stackoverflow.com/questions/57734585/can-i-check-if-a-hashed-password-is-equal-to-a-specific-value-in-laravel
        $this->assertTrue(Hash::check($motDePasse, User::where('email', 'jonathan@email.qc.ca')->first()->password));
    }

    /**
     * Test unitaire permettant de valider qu'ajouter un utilisateur invalide n'est pas fonctionnelle
     */
    public function testStoreInvalide(): void
    {
        // Vérifier que l'utilisateur n'existe pas dans la base de données
        $this->assertDatabaseMissing("users", [
            'name' => 'Carrière',
            'firstname' => 'Jonathan',
            'email' => 'jonathan@email.qc.ca',
            'email_verified_at' => $this->tempsCourriel,
            'password' => 'password123!',
            'role' => 1
        ]);
        // Insérer l'utilisateur dans la base de données via une requête POST
        $reponse = $this->postJson("/api/utilisateurs", [
            'nom' => 'Carrière',
            'prenom' => 'Jonathan',
            'courriel' => 'jonathan@gmail.com',
            'mot_de_passe' => 'password123!',
            'mot_de_passe_confirmation' => 'password123!456',
            'role' => 50
        ]);
        // Vérifier que la requête n'a pas fonctionné
        $reponse->assertStatus(422);
        // Vérifier que la base de données ne contient pas le nouvel utilisateur
        $this->assertDatabaseMissing("users", [
            'name' => 'Carrière',
            'firstname' => 'Jonathan',
            'email' => 'jonathan@gmail.com',
            'email_verified_at' => $this->tempsCourriel,
            'role' => 50
        ]);
    }

    /**
     * Test unitaire permettant de valider que modifier un utilisateur valide est fonctionnelle avec mot de passe
     */
    public function testUpdateValideAvecMotDePasse(): void
    {
        // Modifier l'utilisateur dans la base de données via une requête PUT
        $motDePasse = 'password123!';
        $reponse = $this->putJson("/api/utilisateurs/{$this->utilisateur->id}", [
            'nom' => 'Carrière2',
            'prenom' => 'Jonathan2',
            'courriel' => 'jonathan2@email.qc.ca',
            'mot_de_passe' => $motDePasse,
            'mot_de_passe_confirmation' => $motDePasse,
            'role' => 2
        ]);
        // Vérifier que la requête à fonctionner
        $reponse->assertStatus(201);
        // Vérifier que la base de données contient l'utilisateur modifié
        $this->assertDatabaseHas("users", [
            'name' => 'Carrière2',
            'firstname' => 'Jonathan2',
            'email' => 'jonathan2@email.qc.ca',
            'email_verified_at' => $this->tempsCourriel,
            'role' => 2
        ]);
        // Vérifier que le mot de passe a correctement été haché puis insérer dans la base de données
        // Source : https://stackoverflow.com/questions/57734585/can-i-check-if-a-hashed-password-is-equal-to-a-specific-value-in-laravel
        $this->assertTrue(Hash::check($motDePasse, User::where('email', 'jonathan2@email.qc.ca')->first()->password));
    }

    /**
     * Test unitaire permettant de valider que modifier un utilisateur valide est fonctionnelle sans mot de passe
     */
    public function testUpdateValideSansMotDePasse(): void
    {
        // Modifier l'utilisateur dans la base de données via une requête PUT
        $reponse = $this->putJson("/api/utilisateurs/{$this->utilisateur->id}", [
            'nom' => 'Carrière2',
            'prenom' => 'Jonathan2',
            'courriel' => 'jonathan2@email.qc.ca',
            'role' => 2
        ]);
        // Vérifier que la requête à fonctionner
        $reponse->assertStatus(201);
        // Vérifier que la base de données contient l'utilisateur modifié
        $this->assertDatabaseHas("users", [
            'name' => 'Carrière2',
            'firstname' => 'Jonathan2',
            'email' => 'jonathan2@email.qc.ca',
            'email_verified_at' => $this->tempsCourriel,
            'role' => 2
        ]);
    }

    /**
     * Test unitaire permettant de valider que modifier un utilisateur invalide n'est pas fonctionnelle
     */
    public function testUpdateInvalide(): void
    {
        // Modifier l'utilisateur invalide dans la base de données via une requête PUT
        $reponse = $this->putJson("/api/utilisateurs/{$this->utilisateur->id}", [
            'nom' => 'Carrière',
            'prenom' => 'Jonathan',
            'courriel' => $this->utilisateur->email,
            'mot_de_passe' => 'password123!',
            'mot_de_passe_confirmation' => 'password123!456',
            'role' => 1
        ]);
        // Vérifier que la requête n'a pas fonctionné
        $reponse->assertStatus(422);
        // Vérifier que la base de données ne contient pas l'utilisateur modifié invalide
        $this->assertDatabaseMissing("users", [
            'name' => 'Carrière',
            'firstname' => 'Jonathan',
            'email' => $this->utilisateur->email,
            'email_verified_at' => $this->tempsCourriel,
            'role' => 1
        ]);
    }

    /**
     * Test unitaire permettant de valider que supprimer un utilisateur est fonctionnelle
     */
    public function testDestroy(): void
    {
        // Supprimer l'utilisateur dans la base de données via une requête DELETE
        $reponse = $this->deleteJson("/api/utilisateurs/{$this->utilisateur->id}");
        // Vérifier que la requête à fonctionner
        $reponse->assertStatus(201);
        // Vérifier que la base de données ne contient pas l'utilisateur supprimé
        $this->assertDatabaseMissing("users", [
            "name" => $this->utilisateur->name,
            "firstname" => $this->utilisateur->firstname,
            "email" => $this->utilisateur->email,
            "email_verified_at" => $this->utilisateur->email_verified_at,
            "password" => $this->utilisateur->password,
            "role" => $this->utilisateur->role
        ]);
    }

}
