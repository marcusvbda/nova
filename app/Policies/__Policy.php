<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Auth;

class __Policy
{
    use HandlesAuthorization;
    public function hasPermission($permission) 
    {
        $user = Auth::user();
        return $user->can($permission) || $user->superadmin;
    }
}
