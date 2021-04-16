<?php

use App\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;

class RolePermission01Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'Endereco|Ver']);
        Permission::create(['name' => 'Endereco|Criar']);
        Permission::create(['name' => 'Endereco|Editar']);
        Permission::create(['name' => 'Endereco|Excluir']);

        Permission::create(['name' => 'Cliente|Ver']);
        Permission::create(['name' => 'Cliente|Criar']);
        Permission::create(['name' => 'Cliente|Editar']);
        Permission::create(['name' => 'Cliente|Excluir']);

        Permission::create(['name' => 'Usuário|Ver']);
        Permission::create(['name' => 'Usuário|Criar']);
        Permission::create(['name' => 'Usuário|Editar']);
        Permission::create(['name' => 'Usuário|Excluir']);
        $adminRole = Role::create(['name' => 'Administrador']);
        $adminRole->givePermissionTo([
            'Endereco|Ver', 'Endereco|Criar', 'Endereco|Editar', 'Endereco|Excluir',
            'Cliente|Ver', 'Cliente|Criar', 'Cliente|Editar', 'Cliente|Excluir',
            'Usuário|Ver', 'Usuário|Criar', 'Usuário|Editar', 'Usuário|Excluir',
        ]);
        $editorRole = Role::create(['name' => 'Editor']);
        $editorRole->givePermissionTo([
            'Endereco|Ver', 'Endereco|Criar', 'Endereco|Editar', 'Endereco|Excluir',
            'Cliente|Ver', 'Cliente|Criar', 'Cliente|Editar', 'Cliente|Excluir',
        ]);

        $visualizadorRole = Role::create(['name' => 'Visualizador']);
        $visualizadorRole->givePermissionTo([
            'Endereco|Ver', 'Cliente|Ver'
        ]);

        $admin  = User::create([
            'name' => 'Admin',
            'email' => 'admin@email.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'company_id' => 1
        ]);
        $admin->assignRole('Administrador');

        $editor  = User::create([
            'name' => 'Editor',
            'email' => 'editor@email.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'company_id' => 1
        ]);
        $editor->assignRole('Editor');

        $visualizador  = User::create([
            'name' => 'Visualizador',
            'email' => 'visualizador@email.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'company_id' => 1
        ]);
        $visualizador->assignRole('Visualizador');
    }
}
