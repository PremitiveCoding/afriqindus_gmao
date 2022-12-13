<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Site>
 */
class SiteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'client_id' => Client::all()->random()->id,
            'nom' => $this->faker->sentence(rand(2,3)),
            'email' => $this->faker->unique()->safeEmail(),
            'adresse' => $this->faker->sentence(14),
            'tel' => $this->faker->isbn10(),
            'observation' => $this->faker->date()
        ];
    }
}
