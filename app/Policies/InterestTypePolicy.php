<?php

namespace App\Policies;


class InterestTypePolicy extends __Policy
{
    public function viewAny($user)
    {
        return true;
    }

    public function view($user)
    {
        return $this->hasPermission($user,"Ver Tipos de Interesses");
    }

    public function create($user)
    {
        return $this->hasPermission($user,"Cadastrar Tipos de Interesses");
    }

    public function update($user)
    {
        return $this->hasPermission($user,"Editar Tipos de Interesses");
    }
    
    public function delete($user)
    {
        return $this->hasPermission($user,"Excluir Tipos de Interesses");
    }
}
