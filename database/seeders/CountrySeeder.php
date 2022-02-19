<?php

namespace Database\Seeders;

use App\Models\Country\Country;
use App\Models\Currency\Currency;
use App\Models\LocalizableModel;
use App\Repositories\Country\CountryRepository;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param CountryRepository $repository
     * @return void
     */
    public function run(CountryRepository $repository)
    {
        $countries = File::get(storage_path('seederFiles/countries.json'));
        $countries = json_decode($countries, true);

        $currency = Currency::first();

        foreach ($countries as $item) {
            $country = Country::create([
                Country::CURRENCY_ID => $currency->getId(),
                Country::ISO2 => $item['iso2'],
                Country::ISO3 => $item['iso3']
            ]);
            $country->translations()->createMany([
                'en' => [
                    'locale' => 'en',
                    'name' => $item['en_name']
                ],
                'de' => [
                    'locale' => 'de',
                    'name' => isset($item['de_name']) ? $item['de_name'] : $item['en_name']
                ]
            ]);
        }
    }
}
