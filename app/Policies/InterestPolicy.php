<?php

namespace App\Policies;


class InterestPolicy extends __Policy
{
    public function viewAny($user)
    {
        return true;
    }

    public function view($user)
    {
        return $this->hasPermission($user,"Ver Interesses");
    }

    public function create($user)
    {
        return $this->hasPermission($user,"Cadastrar Interesses");
    }

    public function update($user)
    {
        return $this->hasPermission($user,"Editar Interesses");
    }
    
    public function delete($user)
    {
        return $this->hasPermission($user,"Excluir Interesses");
    }
}
