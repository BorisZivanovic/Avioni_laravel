<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Let;

class LetoviTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Let::create([
            'polaziste' => 'Beograd',
            'odrediste' => 'Pariz',
            'datum' => now(),
            'avionID' => 1, 
        ]);

        Let::create([
            'polaziste' => 'London',
            'odrediste' => 'Njujork',
            'datum' => now()->addDays(1),
            'avionID' => 2, 
        ]);

        Let::create([
            'polaziste' => 'Berlin',
            'odrediste' => 'Rim',
            'datum' => now()->addDays(2),
            'avionID' => 3, 
        ]);

    }
}
