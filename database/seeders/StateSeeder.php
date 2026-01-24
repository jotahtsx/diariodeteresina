<?php

namespace Database\Seeders;

use App\Models\State;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Limpa a tabela para garantir que os estados "inúteis" sumam
        State::query()->delete();

        $states = [
            ['name' => 'Alagoas', 'abbr' => 'AL'],
            ['name' => 'Bahia', 'abbr' => 'BA'],
            ['name' => 'Ceará', 'abbr' => 'CE'],
            ['name' => 'Maranhão', 'abbr' => 'MA'],
            ['name' => 'Paraíba', 'abbr' => 'PB'],
            ['name' => 'Pernambuco', 'abbr' => 'PE'],
            ['name' => 'Piauí', 'abbr' => 'PI'],
            ['name' => 'Rio Grande do Norte', 'abbr' => 'RN'],
            ['name' => 'Sergipe', 'abbr' => 'SE'],
        ];

        foreach ($states as $state) {
            State::create([
                'name' => $state['name'],
                'abbr' => $state['abbr'],
                'slug' => Str::slug($state['name']),
            ]);
        }
    }
}
