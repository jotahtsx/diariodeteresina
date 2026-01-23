<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $states = [
            ['name' => 'Acre', 'abbr' => 'AC'], ['name' => 'Alagoas', 'abbr' => 'AL'],
            ['name' => 'Amapá', 'abbr' => 'AP'], ['name' => 'Amazonas', 'abbr' => 'AM'],
            ['name' => 'Bahia', 'abbr' => 'BA'], ['name' => 'Ceará', 'abbr' => 'CE'],
            ['name' => 'Distrito Federal', 'abbr' => 'DF'], ['name' => 'Espírito Santo', 'abbr' => 'ES'],
            ['name' => 'Goiás', 'abbr' => 'GO'], ['name' => 'Maranhão', 'abbr' => 'MA'],
            ['name' => 'Mato Grosso', 'abbr' => 'MT'], ['name' => 'Mato Grosso do Sul', 'abbr' => 'MS'],
            ['name' => 'Minas Gerais', 'abbr' => 'MG'], ['name' => 'Pará', 'abbr' => 'PA'],
            ['name' => 'Paraíba', 'abbr' => 'PB'], ['name' => 'Paraná', 'abbr' => 'PR'],
            ['name' => 'Pernambuco', 'abbr' => 'PE'], ['name' => 'Piauí', 'abbr' => 'PI'],
            ['name' => 'Rio de Janeiro', 'abbr' => 'RJ'], ['name' => 'Rio Grande do Norte', 'abbr' => 'RN'],
            ['name' => 'Rio Grande do Sul', 'abbr' => 'RS'], ['name' => 'Rondônia', 'abbr' => 'RO'],
            ['name' => 'Roraima', 'abbr' => 'RR'], ['name' => 'Santa Catarina', 'abbr' => 'SC'],
            ['name' => 'São Paulo', 'abbr' => 'SP'], ['name' => 'Sergipe', 'abbr' => 'SE'],
            ['name' => 'Tocantins', 'abbr' => 'TO'],
        ];

        foreach ($states as $state) {
            \App\Models\State::create([
                'name' => $state['name'],
                'abbr' => $state['abbr'],
                'slug' => \Illuminate\Support\Str::slug($state['name']),
            ]);
        }
    }
}
