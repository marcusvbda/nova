<?php

use Illuminate\Database\Seeder;
use App\Status;

class statusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Status::truncate();
        Status::create(["name"=>"Contato"]);
        Status::create(["name"=>"Lead"]);
        Status::create(["name"=>"Oportunidade"]);
        Status::create(["name"=>"Convertido"]);
    }
}
