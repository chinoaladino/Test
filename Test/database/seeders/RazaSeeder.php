<?php

namespace Database\Seeders;

use App\Models\Razas;
use Illuminate\Database\Seeder;
use Whoops\Run;

class RazaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Razas::factory(50)->create();
    }
}
