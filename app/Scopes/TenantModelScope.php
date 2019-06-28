<?php
namespace App\Scopes;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Auth;

class TenantModelScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        $tenant = Auth::user()->tenant;
        $builder->where("tenant_id",$tenant->id);
    }
}