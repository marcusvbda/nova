<?php
namespace App\Scopes;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Providers\ClientConnectionProvider as ClientConnection;
use App\Client;
class ClientModelScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        $subdomain = ClientConnection::getSubDomain();
        $builder->where("client_id",Client::where("subdomain",$subdomain)->firstOrFail()->id);
    }
}