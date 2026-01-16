<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Author;

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
