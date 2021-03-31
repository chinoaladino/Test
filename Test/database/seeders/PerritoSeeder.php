<?php

namespace Database\Seeders;

use App\Models\Perrito;
use Illuminate\Database\Seeder;

class PerritoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Perrito::factory(50)->create();
    }
}
