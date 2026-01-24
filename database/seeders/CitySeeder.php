<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\State;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CitySeeder extends Seeder
{
    public function run(): void
    {
        City::query()->delete();

        $data = [
            'AL' => ['Maceió', 'Arapiraca', 'Rio Largo', 'Palmeira dos Índios', 'Penedo', 'União dos Palmares', 'Marechal Deodoro', 'Coruripe', 'Santana do Ipanema', 'Delmiro Gouveia'],
            'BA' => ['Salvador', 'Feira de Santana', 'Vitória da Conquista', 'Camaçari', 'Juazeiro', 'Itabuna', 'Lauro de Freitas', 'Ilhéus', 'Jequié', 'Porto Seguro'],
            'CE' => ['Fortaleza', 'Caucaia', 'Juazeiro do Norte', 'Maracanaú', 'Sobral', 'Itapipoca', 'Crato', 'Maranguape', 'Iguatu', 'Quixadá'],
            'MA' => ['São Luís', 'Imperatriz', 'Timon', 'Caxias', 'Codó', 'Paço do Lumiar', 'Açailândia', 'Bacabal', 'Balsas', 'Santa Inês'],
            'PB' => ['João Pessoa', 'Campina Grande', 'Santa Rita', 'Patos', 'Bayeux', 'Sousa', 'Cajazeiras', 'Guarabira', 'Cabedelo', 'Sapé'],
            'PE' => ['Recife', 'Jaboatão dos Guararapes', 'Olinda', 'Caruaru', 'Petrolina', 'Paulista', 'Cabo de Santo Agostinho', 'Camaragibe', 'Garanhuns', 'Vitória de Santo Antão'],
            'PI' => ['Teresina', 'Parnaíba', 'Picos', 'Floriano', 'Piripiri', 'Campo Maior', 'Esperantina', 'José de Freitas', 'Altos', 'Oeiras'],
            'RN' => ['Natal', 'Mossoró', 'Parnamirim', 'São Gonçalo do Amarante', 'Macaíba', 'Ceará-Mirim', 'Caicó', 'Assu', 'Currais Novos', 'São José de Mipibu'],
            'SE' => ['Aracaju', 'Nossa Senhora do Socorro', 'Lagarto', 'Itabaiana', 'São Cristóvão', 'Estância', 'Tobias Barreto', 'Itabaianinha', 'Simão Dias', 'Nossa Senhora da Glória'],
        ];

        foreach ($data as $abbr => $cities) {
            $state = State::where('abbr', $abbr)->first();

            if ($state) {
                foreach ($cities as $cityName) {
                    City::create([
                        'state_id' => $state->id,
                        'name' => $cityName,
                        'slug' => Str::slug($cityName . '-' . $abbr),
                    ]);
                }
            }
        }
    }
}
