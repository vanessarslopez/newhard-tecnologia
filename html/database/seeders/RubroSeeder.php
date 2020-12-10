<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\Rubro;

class RubroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        rubro::factory(10)->create();
    }
}
