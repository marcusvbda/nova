<?php

use Illuminate\Database\Seeder;
use App\Interest;

class InterestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Interest::truncate();
        Interest::create(["name"=>"Analise e desenvolvimento de sistemas","interest_type_id" => 1]);
        Interest::create(["name"=>"Direito","interest_type_id" => 1]);
        Interest::create(["name"=>"Medicina","interest_type_id" => 1]);
    }
}
