<?php

namespace Database\Seeders;

use App\Models\Currency\Currency;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = File::get(storage_path('seederFile/Currency.json'));
        $data = json_decode($data, true);

        foreach ($data as $value) {
            try {
                Currency::createObject(
                    $value['title'],
                    $value['ratio'],
                    $value['is_default'],
                    $value['symbol'],
                    $value['Iso3'],
                );
            } catch (\Exception $exception) {
                Log::info($exception);
            }
        }

    }
}
