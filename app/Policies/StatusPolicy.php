<?php

namespace App\Policies;


class StatusPolicy extends __Policy
{
    public function viewAny($user)
    {
        return true;
    }

    public function view($user)
    {
        return $this->hasPermission($user,"Ver Status");
    }

    public function create($user)
    {
        return $this->hasPermission($user,"Cadastrar Status");
    }

    public function update($user)
    {
        return $this->hasPermission($user,"Editar Status");
    }
    
    public function delete($user)
    {
        return $this->hasPermission($user,"Excluir Status");
    }
}
