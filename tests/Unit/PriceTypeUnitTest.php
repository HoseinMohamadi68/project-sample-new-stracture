<?php

namespace Tests\Unit;

use App\Interfaces\Models\Perice\PriceTypeInterface;
use App\Models\LocalizableModel;
use App\Models\Price\PriceType;
use App\Models\Translations\PriceTypeTranslation;
use Tests\TestCase;

class PriceTypeUnitTest extends TestCase
{
    /**
     * @test
     */
    public function createPriceType()
    {
        PriceType::factory()->make();
        $createdPriceType = PriceType::createObject();

        $this->assertTrue($createdPriceType instanceof PriceTypeInterface);
    }


    /**
     * @test
     */
    public function updatePriceType()
    {
        $priceTypesecond = PriceType::factory()->has(PriceTypeTranslation::factory(), 'translations')
            ->create([PriceType::ID => 2]);

        $updatedPriceTypeTranslations = PriceTypeTranslation::factory()->make([PriceTypeTranslation::PRICE_TYPE_ID => null]);

        $priceTypesecond->update(
            [
                LocalizableModel::LOCALIZATION_KEY => [
                    $updatedPriceTypeTranslations
                ]
            ]
        );

        $this->assertTrue($priceTypesecond instanceof PriceTypeInterface);
    }
}

