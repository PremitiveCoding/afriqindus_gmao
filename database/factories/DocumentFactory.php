<?php

namespace Database\Factories;

use App\Models\Intervention;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Document>
 */
class DocumentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'type' => $this->faker-> lexify(),
            'path' => $this->faker-> lexify(),
            'documentable_id' => Intervention::all()->random()->id,
            'documentable_type' => 'App/Models/Intervention',
        ];
    }
}
