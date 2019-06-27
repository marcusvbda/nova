<?php

namespace App\Policies;


class CustomFieldPolicy extends __Policy
{
    public function viewAny($user)
    {
        return true;
    }

    public function view($user)
    {
        return $this->hasPermission($user,"Ver Campos Customizados");
    }

    public function create($user)
    {
        return $this->hasPermission($user,"Cadastrar Campos Customizados");
    }

    public function update($user)
    {
        return $this->hasPermission($user,"Editar Campos Customizados");
    }
    
    public function delete($user)
    {
        return $this->hasPermission($user,"Excluir Campos Customizados");
    }
}
