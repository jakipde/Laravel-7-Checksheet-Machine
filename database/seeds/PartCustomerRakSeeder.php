<?php

use Illuminate\Database\Seeder;
use App\Models\PartCustomerRak;

class PartCustomerRakSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(PartCustomerRak::class, 152)->create();
    }
}
