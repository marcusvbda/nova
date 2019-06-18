<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;

class AuthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        $user = User::create([
            "name"       =>    "administrador",
            "email"      =>    "admin@admin.com",
            "superadmin" =>    true,
            "password"   =>    bcrypt("admin"),
        ]);
        $this->createPermissions();
        $role = $this->createRoles();
        $user->assignRole($role);
    }

    private function createPermissions()
    {
        Permission::truncate();
        $permissions = [
            "Ver Usuários",
            "Cadastrar Usuários",
            "Editar Usuários",
            "Excluir Usuários",
        ];
        foreach($permissions as $permission) 
        {
            Permission::create([
                "guard_name"  =>  "web",
                "name"        =>  $permission,
            ]);
        }
    }

    private function createRoles()
    {
        Role::truncate();
        $role = Role::create([
            "guard_name"  =>  "web",
            "name"        =>  "Administrador",
        ]);
        $role->syncPermissions(Permission::get());
        return $role;
    }
}
