<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        Currency::truncate();

        $data = [
            [
                'iso_code' => 'EUR',
                'iso_numeric' => '123',
                'name' => 'European Composite Unit',
                'symbol' => '€'
            ],
            [
                'iso_code' => 'USD',
                'iso_numeric' => '345',
                'name' => 'Americal Dollar',
                'symbol' => '$'
            ]
        ];

        foreach ($data as $value) {
            Currency::create([
                'iso_code' => $value['iso_code'],
                'iso_numeric' => $value['iso_numeric'],
                'name' => $value['name'],
                'symbol' => $value['symbol'],
            ]);
        }
    }
}
