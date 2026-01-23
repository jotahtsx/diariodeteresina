<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. ESTRUTURA E PERMISSÕES (Base de tudo)
        $this->call([
            RoleSeeder::class,
            StateSeeder::class, // Estados primeiro
            CitySeeder::class,  // Cidades depois (precisam do state_id)
        ]);

        // 2. CONTEÚDO AUXILIAR
        // DICA: Se o CategorySeeder e o PortalStructureSeeder fazem a mesma coisa,
        // use apenas o que estiver mais completo.
        $this->call([
            CategorySeeder::class,
            AuthorSeeder::class,
            PortalStructureSeeder::class,
        ]);

        // 3. USUÁRIOS (Administração)
        if (! User::where('email', 'editor@oracle.com')->exists()) {
            $admin = User::create([
                'name' => 'Editor Oracle',
                'email' => 'editor@oracle.com',
                'password' => Hash::make('a1s5a7'),
            ]);
            $admin->assignRole('admin');
        }

        // 4. CONTEÚDO DINÂMICO (Notícias)
        // O PostSeeder agora tem tudo que precisa: Categorias, Autores, Estados e Cidades.
        $this->call(PostSeeder::class);
    }
}
