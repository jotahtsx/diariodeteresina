<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    public function run(): void
    {
        Author::create([
            'name' => 'Jotah Dev',
            'city' => 'Teresina',
            'state' => 'PI',
        ]);

        Author::create([
            'name' => 'Redação Diário',
            'city' => 'Teresina',
            'state' => 'PI',
        ]);
    }
}
