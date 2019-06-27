<?php

use Illuminate\Database\Seeder;
use App\InterestType;

class InterestTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        InterestType::truncate();
        InterestType::create(["name"=>"Curso"]);
    }
}
