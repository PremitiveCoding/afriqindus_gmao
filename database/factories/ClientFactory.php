<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nom' => $this->faker->lastName(),
            'prenom' => $this->faker->firstName(),
            'ntva' => $this->faker->randomNumber(8, true),
            'email' => $this->faker->safeEmail(),
            'emailSs' => $this->faker->safeEmail(),
            'emailFact' => $this->faker->safeEmail(),
            'adresse' => $this->faker->address(),
            'adresseSs' => $this->faker->address(),
            'tele' => $this->faker->isbn10(),
            'observation' => $this->faker->sentence(),
            'siteInternet' => $this->faker->url(),
        ];
    }
}
