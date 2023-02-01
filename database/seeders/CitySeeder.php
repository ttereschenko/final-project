<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        City::truncate();

        $cities = [
            ['name' => 'Vienna', 'country_id' => 1],
            ['name' => 'Graz', 'country_id' => 1],

            ['name' => 'Minsk', 'country_id' => 2],
            ['name' => 'Vitebsk', 'country_id' => 2],
            ['name' => 'Brest', 'country_id' => 2],
            ['name' => 'Grodno', 'country_id' => 2],
            ['name' => 'Mogilev', 'country_id' => 2],
            ['name' => 'Gomel', 'country_id' => 2],

            ['name' => 'Brussels', 'country_id' => 3],
            ['name' => 'Antwerp', 'country_id' => 3],

            ['name' => 'Prague', 'country_id' => 4],
            ['name' => 'Brno', 'country_id' => 4],

            ['name' => 'Copenhagen', 'country_id' => 5],
            ['name' => 'Aarhus', 'country_id' => 5],

            ['name' => 'Tallinn', 'country_id' => 6],
            ['name' => 'Narva', 'country_id' => 6],

            ['name' => 'Paris', 'country_id' => 7],
            ['name' => 'Marseille', 'country_id' => 7],

            ['name' => 'Berlin', 'country_id' => 8],
            ['name' => 'Hamburg', 'country_id' => 8],

            ['name' => 'Athens', 'country_id' => 9],
            ['name' => 'Thessaloniki', 'country_id' => 9],

            ['name' => 'Budapest', 'country_id' => 10],
            ['name' => 'Debrecen', 'country_id' => 10],

            ['name' => 'Riga', 'country_id' => 11],
            ['name' => 'Daugavpils', 'country_id' => 11],

            ['name' => 'Amsterdam', 'country_id' => 12],
            ['name' => 'Rotterdam', 'country_id' => 12],

            ['name' => 'Oslo', 'country_id' => 13],
            ['name' => 'Bergen', 'country_id' => 13],

            ['name' => 'Warsaw', 'country_id' => 14],
            ['name' => 'Kraków', 'country_id' => 14],

            ['name' => 'Moscow', 'country_id' => 15],
            ['name' => 'St. Petersburg', 'country_id' => 15],
            ['name' => 'Yekaterinburg', 'country_id' => 15],
            ['name' => 'Omsk', 'country_id' => 15],

            ['name' => 'Stockholm', 'country_id' => 16],
            ['name' => 'Gothenburg ', 'country_id' => 16],
        ];

        foreach ($cities as $key => $value) {
            City::create($value);
        }
    }
}
