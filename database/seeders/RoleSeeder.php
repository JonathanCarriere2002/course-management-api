<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

/**
 * Seeder permettant d'insérer des données initiales pour les rôles dans la base de données
 * @author Jonathan Carrière
 */
class RoleSeeder extends Seeder
{
    /**
     * Insérer les objets dans la base de données
     */
    public function run(): void
    {
        // Insérer un rôle dans la base de données
        $role01 = Role::factory()->createOne([
            "nom" => "Administrateur"
        ]);

        // Insérer un rôle dans la base de données
        $role02 = Role::factory()->createOne([
            "nom" => "Conseiller Pédagogique"
        ]);

        // Insérer un rôle dans la base de données
        $role03 = Role::factory()->createOne([
            "nom" => "Service de Recherche et de Développement Pédagogique"
        ]);

        // Insérer un rôle dans la base de données
        $role04 = Role::factory()->createOne([
            "nom" => "Coordonnateur"
        ]);

        // Insérer un rôle dans la base de données
        $role05 = Role::factory()->createOne([
            "nom" => "Enseignant"
        ]);
    }
}
