<?php

namespace Database\Seeders;

use App\Models\Proizvodjac;
use Illuminate\Database\Seeder;

class ProizvodjacTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Proizvodjac::create([
            'proizvodjac' => 'Boeing'
        ]);

        Proizvodjac::create([
            'proizvodjac' => 'Airbus'
        ]);

        Proizvodjac::create([
            'proizvodjac' => 'Safran'
        ]);

    }
}
