<?php

namespace Database\Factories;

use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Commande>
 */
class CommandeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'titre' => $this->faker-> word(2, true),
            'description' => $this->faker->sentence(),
            'adresseLivraison' => $this->faker->sentence(3),
            'dateLivraison' => $this->faker->date(),
            'quantite' => $this->faker->randomDigitNotNull(),
            'total' => $this->faker->randomFloat(2),
            'totalHTVA' => $this->faker->randomFloat(2),
            'article_id' =>  Article::all()->random()->id,
        ];
    }
}

           