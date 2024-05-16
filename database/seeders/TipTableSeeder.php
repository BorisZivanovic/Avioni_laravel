<?php

namespace Database\Seeders;

use App\Models\Tip;
use Illuminate\Database\Seeder;

class TipTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tip::create([
            'tip' => 'Jumbo'
        ]);

        Tip::create([
            'tip' => 'Mid-size'
        ]);
        
        Tip::create([
            'tip' => 'Light'
        ]);

    }
}
