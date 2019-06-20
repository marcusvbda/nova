<?php
namespace App\Observers;
use App\Providers\ClientConnectionProvider as ClientConnection;
use App\Client;
class ClientModelObserver
{
    public function creating($model)
    {
        $subdomain = ClientConnection::getSubDomain();
        if (!$model->client_id) {
            $model->client_id = Client::where("subdomain",$subdomain)->firstOrFail()->id;
        }
    }
}