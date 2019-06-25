<?php

namespace App\Policies;


class TenantPolicy extends __Policy
{
    public function viewAny($user)
    {
        return true;
    }

    public function view($user)
    {
        return $this->hasPermission($user,"Ver Polos");
    }

    public function create($user)
    {
        return $this->hasPermission($user,"Cadastrar Polos");
    }

    public function update($user)
    {
        return $this->hasPermission($user,"Editar Polos");
    }
    
    public function delete($user)
    {
        return $this->hasPermission($user,"Excluir Polos");
    }
}
