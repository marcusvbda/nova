<?php

use Illuminate\Database\Seeder;
use App\Client;
use Illuminate\Support\Facades\Crypt;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Client::truncate();
        Client::updateOrCreate([ //update or create to ignore the model cast connection to array
            "name"    =>  "Empresa de teste",
            "subdomain"    =>  "empresa",
            "connection"   =>  Crypt::encrypt([
                "db_host"    => "127.0.0.1",
                "db_port"    => "3306",
                "user_name"  => "root",
                "password"   => "",
                "database"   => "nova_empresa",
            ]),
        ]);
        Client::updateOrCreate([ //update or create to ignore the model cast connection to array
            "name"    =>  "Empresa 1 de teste",
            "subdomain"    =>  "empresa-1",
            "connection"   =>  Crypt::encrypt([
                "db_host"    => "127.0.0.1",
                "db_port"    => "3306",
                "user_name"  => "root",
                "password"   => "",
                "database"   => "nova_empresa-1",
            ]),
        ]);
    }
}
