<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

class __Policy
{
    use HandlesAuthorization;
    public function hasPermission($user,$permission) 
    {
        return $user->can($permission) || $user->superadmin;
    }
}
