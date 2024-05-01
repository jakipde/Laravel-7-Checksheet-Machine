<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('customers')->insert([
            ['name' => 'AISIN'],
            ['name' => 'SHIROKI'],
            ['name' => 'JFD'],
            ['name' => 'Indosafety'],
            ['name' => 'JFD-MMKI'],
            ['name' => 'OES'],
            ['name' => 'TAM'],
            ['name' => 'TTI'],
            ['name' => 'DSTH'],
            ['name' => 'DNHA'],
            ['name' => 'DNTW'],
            ['name' => 'ACZ'],
        ]);
    }
}