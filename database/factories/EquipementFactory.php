<?php

namespace Database\Factories;

use App\Models\Batiment;
use App\Models\Document;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Equipement>
 */
class EquipementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'code' => $this->faker->randomNumber(5, true),
            'type' => $this->faker->lexify(),
            'qt'=> $this->faker->randomDigitNotNull(),
            'tempsUtilEquip' => $this->faker->randomDigitNotNull(),
            'batiment_id' => Batiment::all()->random()->id,
        ];
    }
}

