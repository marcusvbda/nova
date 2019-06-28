<?php
namespace App\Observers;
use Auth;

class TenantModelObserver
{
    public function creating($model)
    {
        $tenant = Auth::user()->tenant;
        $model->tenant_id = $tenant->id;
    }
}