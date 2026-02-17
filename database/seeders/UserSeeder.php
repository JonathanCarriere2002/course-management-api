<?php

namespace Database\Seeders;

use App\Models\Programme;
use App\Models\User;
use Illuminate\Database\Seeder;

/**
 * Seeder permettant d'insérer des données initiales pour les utilisateurs dans la base de données
 * @author Jonathan Carrière
 */
class UserSeeder extends Seeder
{
    /**
     * Insérer les objets dans la base de données
     */
    public function run(): void
    {

        // Liste contenant l'ensemble des programmes dans la base de données
        $programmes = Programme::all();

        // Insérer un utilisateur dans la base de données
        $utilisateur01 = User::factory()->createOne([
            "name" => "Admin",
            "firstname" => "Admin",
            "email" => "admin@cegepoutaouais.qc.ca",
            "email_verified_at" => now(),
            "password" => bcrypt("defaultPassword"),
            "role" => 1,
            "bureau" => null,
            "poste" => null
        ]);

        // Insérer un utilisateur dans la base de données (Conseiller Pédagogique)
        $utilisateur02 = User::factory()->createOne([
            "name" => "CP",
            "firstname" => "CP",
            "email" => "CP@cegepoutaouais.qc.ca",
            "email_verified_at" => now(),
            "password" => bcrypt("defaultPassword"),
            "role" => 2,
            "bureau" => null,
            "poste" => null
        ]);

        // Insérer un utilisateur dans la base de données
        $utilisateur03 = User::factory()->createOne([
            "name" => "SRDP",
            "firstname" => "SRDP",
            "email" => "SRDP@cegepoutaouais.qc.ca",
            "email_verified_at" => now(),
            "password" => bcrypt("defaultPassword"),
            "role" => 3,
            "bureau" => null,
            "poste" => null
        ]);

        // Insérer un utilisateur dans la base de données
        $utilisateur04 = User::factory()->createOne([
            "name" => "Coordonnateur",
            "firstname" => "Coordonnateur",
            "email" => "Coordonnateur@cegepoutaouais.qc.ca",
            "email_verified_at" => now(),
            "password" => bcrypt("defaultPassword"),
            "role" => 4,
            "bureau" => "1.062",
            "poste" => 1212
        ]);
        $utilisateur04->associerProgrammesSeeder([$programmes[0]->id, $programmes[30]->id]);

        // Insérer un utilisateur dans la base de données
        $utilisateur5 = User::factory()->createOne([
            "name" => "Enseignant",
            "firstname" => "Enseignant",
            "email" => "Enseignant@cegepoutaouais.qc.ca",
            "email_verified_at" => now(),
            "password" => bcrypt("defaultPassword"),
            "role" => 5,
            "bureau" => "1.054",
            "poste" => 3334
        ]);
        $utilisateur5->associerProgrammesSeeder([$programmes[0]->id, $programmes[30]->id]);

    }

}
