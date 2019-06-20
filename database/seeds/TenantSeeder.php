<?php

use Illuminate\Database\Seeder;
use App\Tenant;

class TenantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tenant::truncate();
        Tenant::create(["name"=>"filial 1"]);
        Tenant::create(["name"=>"filial 2"]);
        Tenant::create(["name"=>"filial 3"]);
        Tenant::create(["name"=>"filial 4"]);
    }
}
