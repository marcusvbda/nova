<?php
namespace App\Providers;
use App\Client;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Crypt;
use DB;
use Config;
use Illuminate\Support\Facades\Schema;

class ClientConnectionProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if(@Schema::hasTable('clients'))
        {
            $subdomain = self::getSubDomain();
            $client = Client::where("subdomain",$subdomain)->first();
            if($client)
            {
                if(!$client->enabled)
                    return abort(404);
                $connetion = Crypt::decrypt($client->connection);
                return $this->setClientConnection($connetion);
            }
            return $this->setConnectionMigration();
        }
        $this->setConnectionMigration();
    }
    public function setConnectionMigration()
    {
        DB::disconnect('client');
        Config::set('database.connections.client.database', env("MIGRATE_DB_DATABASE"));
        DB::reconnect('client');
    }
    public static function getSubDomain()
    {
        $host = explode(".",request()->getHost());
        return $host[0]!="localhost" ? $host[0] : config("app.url");
    }
    private function setClientConnection($connection)
    {
        DB::disconnect('client');
        Config::set('database.connections.client.host', $connection["db_host"]);
        Config::set('database.connections.client.post', $connection["db_port"]);
        Config::set('database.connections.client.database', $connection["database"]);
        Config::set('database.connections.client.username', $connection["user_name"]);
        Config::set('database.connections.client.password', $connection["password"]);
        DB::reconnect('client');
    }
}