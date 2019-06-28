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
    // reservation
    // contacts
    // leads
    // prospects
    // converted
    public function run()
    {
        Status::truncate();
        Status::create(["name"=>"Em Espera","definition"=>"reservation"]);
        Status::create(["name"=>"Primeiro Contato","definition"=>"contacts"]);
        Status::create(["name"=>"Reagendamento","definition"=>"leads"]);
        Status::create(["name"=>"Há Interesse","definition"=>"prospects"]);
        Status::create(["name"=>"Negociação","definition"=>"prospects"]);
        Status::create(["name"=>"Aguardando Contra-Prosposta","definition"=>"prospects"]);
        Status::create(["name"=>"Convertido","definition"=>"converted"]);
    }
}
