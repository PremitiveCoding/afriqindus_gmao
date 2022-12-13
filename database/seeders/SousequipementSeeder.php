<?php

namespace Database\Seeders;

use App\Models\SousEquipement;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SousequipementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SousEquipement::factory()
        ->count(20)
        ->create();
    }
}
