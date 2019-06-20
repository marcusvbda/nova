<?php

namespace App\Policies;


class TenantPolicy extends __Policy
{
    public function viewAny($user)
    {
        return $this->hasPermission($user,"Ver Filias");
    }

    public function view($user)
    {
        return $this->hasPermission($user,"Ver Filias");
    }

    public function create($user)
    {
        return $this->hasPermission($user,"Cadastrar Filias");
    }

    public function update($user)
    {
        return $this->hasPermission($user,"Editar Filias");
    }
    
    public function delete($user)
    {
        return $this->hasPermission($user,"Excluir Filias");
    }
}
