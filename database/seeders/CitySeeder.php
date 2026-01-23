<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pi = \App\Models\State::where('abbr', 'PI')->first();
        $ma = \App\Models\State::where('abbr', 'MA')->first();

        $cities = [
            ['state_id' => $pi->id, 'name' => 'Teresina'],
            ['state_id' => $pi->id, 'name' => 'Parnaíba'],
            ['state_id' => $pi->id, 'name' => 'Picos'],
            ['state_id' => $pi->id, 'name' => 'Floriano'],
            ['state_id' => $ma->id, 'name' => 'Timon'],
        ];

        foreach ($cities as $city) {
            \App\Models\City::create([
                'state_id' => $city['state_id'],
                'name' => $city['name'],
                'slug' => \Illuminate\Support\Str::slug($city['name']),
            ]);
        }
    }
}
