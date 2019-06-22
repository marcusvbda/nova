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
        Tenant::create(["name"=>"polo 1","principal"=>true]);
        Tenant::create(["name"=>"polo 2"]);
        Tenant::create(["name"=>"polo 3"]);
        Tenant::create(["name"=>"polo 4"]);
    }
}
