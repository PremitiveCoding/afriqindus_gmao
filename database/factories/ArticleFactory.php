<?php

namespace Database\Factories;

use App\Models\Fournisseur;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nom' => $this->faker-> word(2, true),
            'reference' => $this->faker->ean8(),
            'marque' => $this->faker-> word(),
            'prixAchat' => $this->faker->randomFloat(2),
            'prixVente' => $this->faker->randomFloat(2),
            'emplacement' => $this->faker-> word(2, true),
            'type' => $this->faker-> word(1, true),
            'unite' => $this->faker-> word(1, true),
            'designation' => $this->faker-> word(1, true),
            //'stockMin' => $this->faker->randomDigitNotNull(),
            'quantite' => $this->faker->randomDigitNotNull(),
            // 'vente' => $this->faker-> word(1, true),
            // 'location' => $this->faker-> word(1, true),
            'fournisseur_id' => Fournisseur::all()->random()->id,
        ];
    }
}


