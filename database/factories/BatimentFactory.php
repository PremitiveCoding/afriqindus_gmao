<?php

namespace Database\Factories;

use App\Models\Site;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Batiment>
 */
class BatimentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nom' => $this->faker-> word(),
            'site_id' => Site::all()->random()->id,
            'adresse' => $this->faker-> sentence(),
            'email' => $this->faker->unique()->safeEmail(),
            'numero' => $this->faker-> isbn10()
        ];
    }
}
