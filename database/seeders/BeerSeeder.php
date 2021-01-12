<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BeerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $beers = \App\Models\Beer::factory()->count(10)->create();
    }
}
