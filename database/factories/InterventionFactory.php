<?php

namespace Database\Factories;

use App\Models\Site;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Intervention>
 */
class InterventionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'titre' => $this->faker-> word(),
            'site_id' => Site::all()->random()->id,
            'type' => $this->faker-> lexify(),
            'desc' => $this->faker->sentence(),
            'urgence' => $this->faker->randomElement(['Immédiate','Dès que possible','Au prochain arrêt']),
            'status' => $this->faker->randomElement(['Effectuée', 'Planifiée','Annulée']),
            'dateDb' => $this->faker-> date(),
            'dateFn' => $this->faker-> date(),
            'etat' => $this->faker->randomElement(['Ouvert','Clôt']),
            'tempsNes' => $this->faker->time(),
            'frequence' => $this->faker->randomElement(['Quotidien','Hebdomadaire','Mensuel','Annuel']),
        ];
    }
}
