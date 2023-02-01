<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Country::truncate();

        $countries = [
            ['name' => 'Austria'],
            ['name' => 'Belarus'],
            ['name' => 'Belgium'],
            ['name' => 'Czech'],
            ['name' => 'Denmark'],
            ['name' => 'Estonia'],
            ['name' => 'France'],
            ['name' => 'Germany'],
            ['name' => 'Greece'],
            ['name' => 'Hungary'],
            ['name' => 'Latvia'],
            ['name' => 'Netherlands'],
            ['name' => 'Norway'],
            ['name' => 'Poland'],
            ['name' => 'Russia'],
            ['name' => 'Sweden'],
        ];

        foreach ($countries as $key => $value) {
            Country::create($value);
        }
    }
}



