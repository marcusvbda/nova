<?php
namespace App\Observers;
use Auth;

class TenantModelObserver
{
    public function creating($model)
    {
        if(!$model->tenant_id)
        {
            $tenant = Auth::user()->tenant;
            $model->tenant_id = $tenant->id;
        }
    }
}