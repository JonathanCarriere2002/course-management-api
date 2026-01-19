<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

/**
 * Tests unitaires associés aux rôles
 * @author Jonathan Carrière
 */
class RoleTest extends TestCase
{
    // Configuration pour la base de données
    use DatabaseTransactions;

    // Rôle utilisé dans les tests unitaires
    private Role $role;

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
        // Création d'un rôle
        $this->role = Role::factory()->createOne();
    }

    /**
     * Test unitaire permettant de valider que l'API peut envoyer la liste des rôles
     */
    public function testIndex(): void
    {
        // Vérifier que l'API peut envoyer la liste des rôles
        $reponse = $this->getJson("/api/roles");
        $reponse->assertStatus(201);
    }

}
