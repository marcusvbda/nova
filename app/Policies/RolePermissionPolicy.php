<?php

namespace App\Policies;

class RolePermissionPolicy extends __Policy
{

    public function viewAny($user)
    {
        return true;
    }

    public function create($user)
    {
        return $user->superadmin;
    }

    public function view($user)
    {
        return $user->superadmin;
    }

    public function update($user)
    {
        return $user->superadmin;
    }
    
    public function delete($user)
    {
        return $user->superadmin;
    }
}
