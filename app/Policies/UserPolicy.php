<?php

namespace App\Policies;

class UserPolicy extends __Policy
{
    public function viewAny()
    {
        return $this->hasPermission("Ver Usuários");
    }

    public function view()
    {
        return $this->hasPermission("Ver Usuários");
    }

    public function create()
    {
        return $this->hasPermission("Cadastrar Usuários");
    }

    public function update()
    {
        return $this->hasPermission("Editar Usuários");
    }
    
    public function delete()
    {
        return $this->hasPermission("Excluir Usuários");
    }
}
