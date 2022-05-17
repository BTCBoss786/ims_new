<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaxSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('taxes')->insert([
            ['rate' => 0.00],
            ['rate' => 0.25],
            ['rate' => 3.00],
            ['rate' => 5.00],
            ['rate' => 12.00],
            ['rate' => 18.00],
            ['rate' => 28.00],
        ]);
    }

}
