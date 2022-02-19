<?php

namespace Database\Seeders;

use App\Constants\PriceTypeConstant;
use App\Models\LocalizableModel;
use App\Models\Price\PriceType;
use App\Models\Translations\PriceTypeTranslation;
use App\Repositories\Price\PriceTypeRepository;
use Illuminate\Database\Seeder;
use ReflectionClass;

class PriceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $class = new ReflectionClass(PriceTypeConstant::class);

        foreach ($class->getConstants() as  $priceType) {
            PriceType::createObject(
                [
                    LocalizableModel::LOCALIZATION_KEY => [
                        [
                            PriceTypeTranslation::LOCALE => "en",
                            PriceTypeTranslation::NAME => $priceType
                        ]
                    ]
                ]
            );
        }
    }
}
