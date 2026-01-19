<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PlanCadre>
 */
class PlanCadreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "code" => fake()->regexify('^\d{3}-\d[A-Z]\d-[A-Z]{2}$'),
            "titre"=>fake()->randomElement(["DEVELOPPEMENT WEB EN PHP","DEVELOPPEMENT WEB EN ASP.NET","SOUTIEN INFORMATIQUE","DEVELOPPEMENT D'APPLICATIONS MOBILES"]),
            "ponderation"=>fake()->randomElement(["1-2-2", "1-2-3","1-3-2","2-2-2","1-2-1","1-3-1","1-3-2","3-1-1","3-0-1"]),
            "unites"=>fake()->randomFloat(2,1,4),

//            "attitudes"=>fake()->text(100),
//            "intentionsPedagogiques"=>fake()->text(100),
//            "intentionsEducatives"=>fake()->text(100),
//            "pagesdevisIntentionsEducatives"=>fake()->numberBetween(1, 100),
//            "anneesdevisIntentionsEducatives"=>fake()->numberBetween(2000, 2023),
//            "descCours"=>fake()->text(100),

            "ponderationFinale"=>60,
            "changement"=>fake()->date(),
            "dateApprobationDepartement"=>null,
            "dateApprobationComiteProgrammes"=>null,
            "dateDepotDirectionEtudes"=>null,
            'created_at'=>now(),
            'updated_at'=>now(),
        ];
    }
}
