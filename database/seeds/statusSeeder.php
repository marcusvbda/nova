<?php

use Illuminate\Database\Seeder;
use App\Status;
use App\StatusDefinition;

class StatusSeeder extends Seeder
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
        StatusDefinition::truncate();
        
        $definition = StatusDefinition::create(["name"=>"Reservados"]);
        Status::create(["name"=>"Em Espera","definition_id"=>$definition->id,"color" => "#444444"]);

        $definition = StatusDefinition::create(["name"=>"Contatos"]);
        Status::create(["name"=>"Primeiro Contato","definition_id"=>$definition->id,"color" => "#E16D1E"]);

        $definition = StatusDefinition::create(["name"=>"Leads"]);
        Status::create(["name"=>"Reagendamento","definition_id"=>$definition->id,"color" => "#1E97E1"]);

        $definition = StatusDefinition::create(["name"=>"Prospects"]);
        Status::create(["name"=>"Há Interesse","definition_id"=>$definition->id,"color" => "#A41EE1"]);
        Status::create(["name"=>"Negociação","definition_id"=>$definition->id,"color" => "#02E3DD"]);
        Status::create(["name"=>"Aguardando Contra-Prosposta","definition_id"=>$definition->id,"color" => "#FD00FF"]);

        $definition = StatusDefinition::create(["name"=>"Convertidos"]);
        Status::create(["name"=>"Convertido","definition_id"=>$definition->id,"color" => "#129C3E"]);
    }
}
