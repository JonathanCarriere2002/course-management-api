<?php

namespace Database\Factories;

use App\Models\Session;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Factory permettant de créer des données initiales pour les sessions
 * @extends Factory<Session> Factory pour des objets de type 'sessions'
 * @author Jonathan Carrière
 */
class SessionFactory extends Factory
{
    /**
     * Méthode permettant de créer des données initiales pour les sessions
     * @return array Array contenant les sessions initiales
     */
    public function definition(): array
    {
        return [
            'session' => fake()->randomElement(['Automne', 'Hiver', 'Été']),
            'annee' => fake()->year(),
            'limite_abandon' => fake()->dateTime(),
            'created_at'=>now(),
            'updated_at'=>now()
        ];
    }

}
