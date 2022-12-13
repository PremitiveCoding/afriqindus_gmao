<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Fournisseur>
 */
class FournisseurFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'tel' => $this->faker->isbn10(),
            'nom' => $this->faker->lastName(),
            'email' => $this->faker->safeEmail(),
            'tauxTVA' => $this->faker->randomFloat(2),
            'code' => $this->faker->isbn10(),
            'remarque' => $this->faker->sentence(4),
            'adresse' => $this->faker->sentence(3),
            'telSec' => $this->faker->isbn10(),
            'numTVA' => $this->faker->numerify(),
        ];
    }
}

