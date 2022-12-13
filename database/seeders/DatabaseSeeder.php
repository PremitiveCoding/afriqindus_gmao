<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            FournisseurSeeder::class,
            ArticleSeeder::class,
            CommandeSeeder::class,
            ClientSeeder::class,
            SiteSeeder::class,
            InterventionSeeder::class,
            BatimentSeeder::class,
            EquipementSeeder::class,
            SousequipementSeeder::class,
        ]);
    }
}
