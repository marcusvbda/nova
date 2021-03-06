<?php

namespace App\Policies;

class SuperAdminPolicy extends __Policy
{

    public function viewAny($user)
    {
        return $user->superadmin;
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
