<?php

use Illuminate\Database\Seeder;
use App\Lead;

class LeadsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Lead::truncate();
        // factory(Lead::class, 1000)->create();
    }
}
