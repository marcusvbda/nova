<?php

namespace App\Policies;

class UserPolicy extends __Policy
{
    public function viewAny($user)
    {
        return true;
    }

    public function view($user)
    {
        return $this->hasPermission($user,"Ver Usuários");
    }

    public function create($user)
    {
        return $this->hasPermission($user,"Cadastrar Usuários");
    }

    public function update($user)
    {
        return $this->hasPermission($user,"Editar Usuários");
    }
    
    public function delete($user)
    {
        return $this->hasPermission($user,"Excluir Usuários");
    }
}
