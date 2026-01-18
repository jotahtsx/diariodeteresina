<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Usando o caminho completo para garantir que o PHP encontre a classe
        \Spatie\Permission\Models\Permission::create(['name' => 'ver noticias']);
        \Spatie\Permission\Models\Permission::create(['name' => 'criar noticias']);
        
        $admin = \Spatie\Permission\Models\Role::create(['name' => 'admin']);
        $admin->givePermissionTo(['ver noticias', 'criar noticias']);
    }
}
