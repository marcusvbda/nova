<?php

namespace App\Policies;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClientPolicy 
{
    use HandlesAuthorization;
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
