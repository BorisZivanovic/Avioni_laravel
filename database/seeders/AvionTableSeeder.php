<?php

namespace Database\Seeders;

use App\Models\Avion;
use Illuminate\Database\Seeder;

class AvionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 30; $i++) {

            Avion::create([
                'proizvodjacID' => rand(1,3),
                'model' => $faker->numerify(),
                'tipID' => rand(1,3),
                'opis' => $faker->sentence(20)
            ]);
        }
    }
}
