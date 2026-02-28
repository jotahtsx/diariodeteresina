<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. ESTRUTURA E PERMISSÕES
        $this->call([
            RoleSeeder::class,
            StateSeeder::class,
            CitySeeder::class,
        ]);

        // 2. CRIAR O USUÁRIO ADMIN (O autor principal)
        if (! User::where('email', 'editor@oracle.com')->exists()) {
            $admin = User::create([
                'name' => 'Editor Oracle',
                'email' => 'editor@oracle.com',
                'password' => Hash::make('a1s5a7'),
            ]);
            $admin->assignRole('admin');
        }

        // 3. CONTEÚDO AUXILIAR
        $this->call([
            CategorySeeder::class,
            AuthorSeeder::class,
            PortalStructureSeeder::class,
        ]);

        // 4. CONTEÚDO DINÂMICO (Usando o PostSeeder que te mandei)
        $this->call(PostSeeder::class);
    }
}