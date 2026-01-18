<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. ACL (Base de tudo) - Cria Roles e Permissions
        $this->call(RoleSeeder::class);

        // 2. FUNDAÇÃO (Categorias e Autores)
        // DICA: Se o CategorySeeder e o PortalStructureSeeder criam as mesmas categorias,
        // comente um deles ou garanta que o PortalStructureSeeder não repita slugs!
        $this->call(CategorySeeder::class);
        $this->call(AuthorSeeder::class);
        $this->call(PortalStructureSeeder::class);

        // 3. PESSOAS (Criação manual do usuário Oracle)
        $admin = User::create([
            'name' => 'Editor Oracle',
            'email' => 'editor@oracle.com',
            'password' => Hash::make('a1s5a7'),
        ]);

        // Atribui o cargo de admin que foi criado lá no RoleSeeder
        $admin->assignRole('admin');

        // 4. CONTEÚDO (Notícias)
        // Agora que temos Categorias, Autores e o Usuário logado, os posts podem ser criados.
        $this->call(PostSeeder::class);
    }
}
