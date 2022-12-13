<?php

namespace Database\Seeders;

use App\Models\Equipement;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EquipementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Equipement::factory()
        ->count(10)
        ->create();
    }
}
