<?php

namespace Database\Factories;

use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * Factory permettant de créer des données initiales pour les rôles
 * @extends Factory<Role> Factory pour des objets de type 'role'
 * @author Jonathan Carrière
 */
class RoleFactory extends Factory
{
    /**
     * Méthode permettant de créer des données initiales pour les rôles
     * @return array Array contenant les rôles initiaux
     */
    public function definition(): array
    {
        return [
            'nom' => fake()->randomElement(['Admin', 'CP', 'SRDP', 'Coordonnateur', 'Enseignant']),
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
