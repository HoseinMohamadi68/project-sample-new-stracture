<?php

namespace Tests\Unit;

use App\Interfaces\Models\Country\CountryInterface;
use App\Models\Country\Country;
use App\Models\Currency\Currency;
use App\Models\LocalizableModel;
use App\Models\Translations\CountryTranslation;
use Tests\TestCase;

class CountryUnitTest extends TestCase
{
    /**
     * @test
     */
    public function createCountry()
    {
        $currency = Currency::factory()->create();
        $country = Country::factory()->make();
        $createdCountry = Country::createObject(
            [
                Country::CURRENCY_ID => $currency->getId(),
                Country::DEFAULT_VAT => $country->getDefaultVat(),
                Country::DEFAULT_WARRANTY_DAYS => $country->getDefaultWarrantyDays(),
                Country::MAX_TAX_FREE_TRADE => $country->getMaxTaxFreeTrade(),
                Country::MAX_SMALL_BUSINESS_TRADE => $country->getMaxSmallBusinessTrade(),
                Country::IS_EEU => $country->getIsEeu(),
                Country::ISO2 => $country->getIso_2(),
                Country::ISO3 => $country->getIso_3(),
            ]
        );

        $this->assertTrue($createdCountry instanceof CountryInterface);
        $this->assertEquals($createdCountry->getCurrencyId(), $currency->getId());
        $this->assertEquals($createdCountry->getDefaultVat(), $country->getDefaultVat());
        $this->assertEquals($createdCountry->getDefaultWarrantyDays(), $country->getDefaultWarrantyDays());
        $this->assertEquals($createdCountry->getMaxTaxFreeTrade(), $country->getMaxTaxFreeTrade());
        $this->assertEquals($createdCountry->getMaxSmallBusinessTrade(), $country->getMaxSmallBusinessTrade());
        $this->assertEquals($createdCountry->getIsEeu(), $country->getIsEeu());
        $this->assertEquals($createdCountry->getIso_2(), $country->getIso_2());
        $this->assertEquals($createdCountry->getIso_3(), $country->getIso_3());

        $this->assertDatabaseHas(
            Country::TABLE,
            [
                Country::CURRENCY_ID => $currency->getId(),
                Country::DEFAULT_VAT => $country->getDefaultVat(),
                Country::DEFAULT_WARRANTY_DAYS => $country->getDefaultWarrantyDays(),
                Country::MAX_TAX_FREE_TRADE => $country->getMaxTaxFreeTrade(),
                Country::MAX_SMALL_BUSINESS_TRADE => $country->getMaxSmallBusinessTrade(),
                Country::IS_EEU => $country->getIsEeu(),
                Country::ISO2 => $country->getIso_2(),
                Country::ISO3 => $country->getIso_3(),

            ]
        );


    }

    /**
     * @test
     */
    public function updateCountry()
    {

        $currency = Currency::factory(1)->create()->first();
        $country = Country::factory()->has(CountryTranslation::factory(), 'translations')
            ->create([Country::CURRENCY_ID => 1]);
        $updatedCountry = Country::factory()->make([Country::CURRENCY_ID => 2]);
        $updatedCountryTranslations = CountryTranslation::factory()->make([CountryTranslation::COUNTRY_ID => null]);

        $country->update(
            [
                Country::DEFAULT_VAT => $updatedCountry->getDefaultVat(),
                Country::DEFAULT_WARRANTY_DAYS => $updatedCountry->getDefaultWarrantyDays(),
                Country::MAX_TAX_FREE_TRADE => $updatedCountry->getMaxTaxFreeTrade(),
                Country::MAX_SMALL_BUSINESS_TRADE => $updatedCountry->getMaxSmallBusinessTrade(),
                Country::IS_EEU => $updatedCountry->getIsEeu(),
                Country::ISO2 => $updatedCountry->getIso_2(),
                Country::ISO3 => $updatedCountry->getIso_3(),
                LocalizableModel::LOCALIZATION_KEY => [
                    $updatedCountryTranslations
                ]
            ]
        );


        $this->assertTrue($updatedCountry instanceof CountryInterface);
        $this->assertEquals($country->getDefaultVat(), $updatedCountry->getDefaultVat());
        $this->assertEquals($country->getDefaultWarrantyDays(), $updatedCountry->getDefaultWarrantyDays());
        $this->assertEquals($country->getMaxTaxFreeTrade(), $updatedCountry->getMaxTaxFreeTrade());
        $this->assertEquals($country->getMaxSmallBusinessTrade(), $updatedCountry->getMaxSmallBusinessTrade());
        $this->assertEquals($country->getIsEeu(), $updatedCountry->getIsEeu());
        $this->assertEquals($country->getIso_2(), $updatedCountry->getIso_2());
        $this->assertEquals($country->getIso_3(), $updatedCountry->getIso_3());

        $this->assertDatabaseHas(
            Country::TABLE,
            [
                Country::CURRENCY_ID => $currency->getId(),
                Country::DEFAULT_VAT => $country->getDefaultVat(),
                Country::DEFAULT_WARRANTY_DAYS => $country->getDefaultWarrantyDays(),
                Country::MAX_TAX_FREE_TRADE => $country->getMaxTaxFreeTrade(),
                Country::MAX_SMALL_BUSINESS_TRADE => $country->getMaxSmallBusinessTrade(),
                Country::IS_EEU => $country->getIsEeu(),
                Country::ISO2 => $country->getIso_2(),
                Country::ISO3 => $country->getIso_3(),

            ]
        );
    }
}
