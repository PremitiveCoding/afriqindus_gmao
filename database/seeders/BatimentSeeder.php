<?php

namespace Database\Seeders;

use App\Models\Batiment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BatimentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Batiment::factory()
        ->count(15)
        ->create();
    }
}
