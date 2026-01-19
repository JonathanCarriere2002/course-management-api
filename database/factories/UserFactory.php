<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * Factory permettant de créer des données initiales pour les utilisateurs
 * @extends Factory<User> Factory pour des objets de type 'user'
 * @author Jonathan Carrière
 */
class UserFactory extends Factory
{
    /**
     * Méthode permettant de créer des données initiales pour les utilisateurs
     * @return array Array contenant les utilisateurs initiaux
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'firstname' => fake()->firstName(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'role' => 1,
            'remember_token' => Str::random(10),
            'bureau' => fake()->randomElement(['1.063', '1.075', '1.085', '1.105', '2.708']),
            'poste' => fake()->randomElement([2000, 2005, 2010, 2015, 2020]),
            'created_at' => now(),
            'updated_at' => now()
        ];
    }

    /**
     * Méthode permettant d'indiquer que l'adresse courriel d'un utilisateur peut être non définie
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

}
