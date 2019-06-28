<?php

use Illuminate\Database\Seeder;
use App\CustomField;

class CustomFieldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CustomField::truncate();
        CustomField::create(["name"=>"Curso","type" => "select","options"=>[
            "Analise e desenvolvimento de sistemas",
            "Medicina",
        ]]);
    }
}
