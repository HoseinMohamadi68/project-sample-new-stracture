<?php

namespace Database\Seeders;

use App\Models\Language\Language;
use File;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get("storage/seederFiles/languages.json");
        $data = json_decode($json, true);
        foreach ($data as $obj){
            Language::firstOrCreate($obj, $obj);
        }
    }
}
