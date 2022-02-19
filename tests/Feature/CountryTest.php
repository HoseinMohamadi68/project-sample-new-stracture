<?php

namespace Tests\Feature;

use App\Constants\PermissionTitle;
use App\Models\Country\Country;
use App\Models\Currency\Currency;
use App\Models\Language\Language;
use App\Models\LocalizableModel;
use App\Models\Network\Network;
use App\Models\Translations\CountryTranslation;
use App\Models\User\Permission;
use App\Models\User\User;
use Database\Factories\Language\LanguageFactory;
use Database\Seeders\LanguageSeeder;
use Illuminate\Http\Response;
use Tests\TestCase;
use function Symfony\Component\Translation\t;

class CountryTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(LanguageSeeder::class);
    }


    private function getCountriesIndex()
    {
        Country::factory()->count(10)->has(CountryTranslation::factory(), 'translations')->create([Country::CURRENCY_ID => 1]);
        $response = $this->getJson(
            route('countries.index')
        )->assertOk();

        $this->assertEquals(count($response->getOriginalContent()), 10);
        $response = $this->getJson(
            route('countries.index', ['per_page' => 5])
        )->assertOk();
        $this->assertEquals(count($response->getOriginalContent()), 5);
    }

    private function showCountry()
    {
        $country = Country::factory()->has(CountryTranslation::factory(), 'translations')->create([Country::CURRENCY_ID => 1]);
        $this->getJson(
            route('countries.show', $country)
        )->assertOk();
    }

    /**
     * @test
     */
    public function userWithoutLoginCanGetAllCountries()
    {
        $this->getCountriesIndex();
    }

    /**
     * @test
     */
    public function userWithoutPermissionCanGetAllCountries()
    {
        $this->actingAsUser();
        $this->getCountriesIndex();
    }

    /**
     * @test
     */
    public function userWithPermissionCanGetAllCountries()
    {
        $this->actingAsUserWithPermission(PermissionTitle::GET_ALL_COUNTRIES);
        $this->getCountriesIndex();
    }

    /**
     * @test
     */
    public function userWithoutLoginCanGetCountry()
    {
        $this->showCountry();
    }

    /**
     * @test
     */
    public function userWithoutPermissionCanGetCountry()
    {
        $this->actingAsUser();
        $this->showCountry();
    }

    /**
     * @test
     */
    public function getCountry()
    {
        $this->actingAsUserWithPermission(PermissionTitle::GET_COUNTRY);
        $this->showCountry();
    }

    /**
     * @test
     */
    public function userWithoutLoginCanNotStoreCountry()
    {
        $this->postJson(
            route('countries.store', [])
        )->assertUnauthorized();
    }

    /**
     * @test
     */
    public function userWithoutPermissionCanNotStoreCountry()
    {
        $this->actingAsUser();
        $this->postJson(
            route('countries.store'),
            []
        )->assertForbidden();
    }

    /**
     * @test
     */
    public function userWithPermissionCanStoreCountry()
    {
        $this->actingAsUserWithPermission(PermissionTitle::CREATE_COUNTRY);
        $currency = Currency::factory()->create();
        $country = Country::factory()->make([Country::CURRENCY_ID => $currency->id]);
        $countryTranslations = CountryTranslation::factory()->make([CountryTranslation::COUNTRY_ID => null]);
        $response = $this->postJson(
            route('countries.store'),
            [
                Country::CURRENCY_ID => $country->getCurrencyId(),
                Country::DEFAULT_VAT => $country->getDefaultVat(),
                Country::DEFAULT_WARRANTY_DAYS => $country->getDefaultWarrantyDays(),
                Country::MAX_TAX_FREE_TRADE => $country->getMaxTaxFreeTrade(),
                Country::MAX_SMALL_BUSINESS_TRADE => $country->getMaxSmallBusinessTrade(),
                Country::IS_EEU => $country->getIsEeu(),
                Country::ISO2 => $country->getIso_2(),
                Country::ISO3 => $country->getIso_3(),
                LocalizableModel::LOCALIZATION_KEY => [
                    $countryTranslations
                ]
            ]
        )->assertCreated();

        $this->assertEquals($response->getOriginalContent()->translations->first()->getName(), $countryTranslations->getName());
        $this->assertEquals($response->getOriginalContent()->translations->first()->getLocale(), $countryTranslations->getLocale());
        $this->assertEquals($response->getOriginalContent()->getCurrencyId(), $country->getCurrencyId());
        $this->assertEquals($response->getOriginalContent()->getDefaultVat(), $country->getDefaultVat());
        $this->assertEquals($response->getOriginalContent()->getDefaultWarrantyDays(), $country->getDefaultWarrantyDays());
        $this->assertEquals($response->getOriginalContent()->getMaxTaxFreeTrade(), $country->getMaxTaxFreeTrade());
        $this->assertEquals($response->getOriginalContent()->getMaxSmallBusinessTrade(), $country->getMaxSmallBusinessTrade());
        $this->assertEquals($response->getOriginalContent()->getIsEeu(), $country->getIsEeu());
        $this->assertEquals($response->getOriginalContent()->getIso_2(), $country->getIso_2());
        $this->assertEquals($response->getOriginalContent()->getIso_3(), $country->getIso_3());


    }

    /**
     * @test
     */
    public function userWithoutLoginCanNotUpdateCountry()
    {
        $country = Country::factory()->create([Country::CURRENCY_ID => 1]);
        $this->putJson(
            route('countries.update', $country),
            []
        )->assertUnauthorized();
    }

    /**
     * @test
     */
    public function userWithoutPermissionCanNotUpdateCountry()
    {
        $country = Country::factory()->create([Country::CURRENCY_ID => 1]);
        $this->actingAsUser();
        $this->putJson(
            route('countries.update', $country),
            []
        )->assertForbidden();
    }

    /**
     * @test
     */
    public function userWithPermissionCanUpdateCountry()
    {
        $this->actingAsUserWithPermission(PermissionTitle::UPDATE_COUNTRY);
        Currency::factory(2)->create();
        $country = Country::factory()->has(CountryTranslation::factory(), 'translations')->create([Country::CURRENCY_ID => 1]);
        $updatedCountry = Country::factory()->make([Country::CURRENCY_ID => 2]);
        $updatedCountryTranslations = CountryTranslation::factory()->make([CountryTranslation::COUNTRY_ID => null]);

        $response = $this->putJson(
            route('countries.update', $country),
            [
                Country::CURRENCY_ID => $updatedCountry->getCurrencyId(),
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

        $response->getOriginalContent()->load('translations');
        $response->assertOk();
        $this->assertEquals($response->getOriginalContent()->translations->first()->getName(), $updatedCountryTranslations->getName());
        $this->assertEquals($response->getOriginalContent()->translations->first()->getLocale(), $updatedCountryTranslations->getLocale());
        $this->assertEquals($response->getOriginalContent()->getCurrencyId(), $updatedCountry->getCurrencyId());
        $this->assertEquals($response->getOriginalContent()->getDefaultVat(), $updatedCountry->getDefaultVat());
        $this->assertEquals($response->getOriginalContent()->getDefaultWarrantyDays(), $updatedCountry->getDefaultWarrantyDays());
        $this->assertEquals($response->getOriginalContent()->getMaxTaxFreeTrade(), $updatedCountry->getMaxTaxFreeTrade());
        $this->assertEquals($response->getOriginalContent()->getMaxSmallBusinessTrade(), $updatedCountry->getMaxSmallBusinessTrade());
        $this->assertEquals($response->getOriginalContent()->getIsEeu(), $updatedCountry->getIsEeu());
        $this->assertEquals($response->getOriginalContent()->getIso_2(), $updatedCountry->getIso_2());
        $this->assertEquals($response->getOriginalContent()->getIso_3(), $updatedCountry->getIso_3());
    }

    /**
     * @test
     */
    public function userWithoutLoginCanNotDeleteCountry()
    {
        $country = Country::factory()->create([Country::CURRENCY_ID => 1]);
        $this->deleteJson(
            route('countries.destroy', $country)
        )->assertUnauthorized();
    }

    /**
     * @test
     */
    public function userWithoutPermissionCanNotDeleteCountry()
    {
        $this->actingAsUser();
        $country = Country::factory()->create([Country::CURRENCY_ID => 1]);
        $this->deleteJson(
            route('countries.destroy', $country)
        )->assertForbidden();
    }

    /**
     * @test
     */
    public function userWithPermissionCanDeleteCountry()
    {
        $this->actingAsUserWithPermission(PermissionTitle::DELETE_COUNTRY);
        $country = Country::factory()->create([Country::CURRENCY_ID => 1]);
        $this->deleteJson(
            route('countries.destroy', $country)
        )->assertNoContent();
    }

    /**
     * @test
     */
    public function userCanNotUpdateCountryWithoutRequiredField()
    {
        $this->actingAsUserWithPermission(PermissionTitle::UPDATE_COUNTRY);
        Currency::factory(2)->create();
        $country = Country::factory()->has(CountryTranslation::factory(), 'translations')->create([Country::CURRENCY_ID => 1]);

        $response = $this->putJson(
            route('countries.update', $country),
            []
        )->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);;

        /** @var array $content */
        $content = $response->getOriginalContent()->toArray();

        $this->assertArrayHasKey(Country::CURRENCY_ID, $content);
        $this->assertArrayHasKey(Country::DEFAULT_VAT, $content);
        $this->assertArrayHasKey(Country::DEFAULT_WARRANTY_DAYS, $content);
        $this->assertArrayNotHasKey(Country::MAX_TAX_FREE_TRADE, $content);
        $this->assertArrayNotHasKey(Country::MAX_SMALL_BUSINESS_TRADE, $content);
        $this->assertArrayHasKey(Country::IS_EEU, $content);
        $this->assertArrayHasKey(Country::ISO2, $content);
        $this->assertArrayHasKey(Country::ISO3, $content);
    }

    /**
     * @test
     */
    public function UserCanNotUpdateCountryWithInvalidFieldParameter()
    {
        $this->actingAsUserWithPermission(PermissionTitle::UPDATE_COUNTRY);
        Currency::factory(2)->create();
        $country = Country::factory()->has(CountryTranslation::factory(), 'translations')->create([Country::CURRENCY_ID => 1]);

        $response = $this->putJson(
            route('countries.update', $country),
            [
                Country::CURRENCY_ID => 12,
                Country::DEFAULT_VAT => 'v',
                Country::DEFAULT_WARRANTY_DAYS => 'a',
                Country::MAX_TAX_FREE_TRADE => 'd',
                Country::MAX_SMALL_BUSINESS_TRADE => 's',
                Country::IS_EEU => 123,
                Country::ISO2 => '1234',
                Country::ISO3 => '1',
            ]
        )->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        /** @var array $content */
        $content = $response->getOriginalContent()->toArray();

        $this->assertArrayHasKey(Country::CURRENCY_ID, $content);
        $this->assertArrayHasKey(Country::DEFAULT_VAT, $content);
        $this->assertArrayHasKey(Country::DEFAULT_WARRANTY_DAYS, $content);
        $this->assertArrayHasKey(Country::MAX_TAX_FREE_TRADE, $content);
        $this->assertArrayHasKey(Country::MAX_SMALL_BUSINESS_TRADE, $content);
        $this->assertArrayHasKey(Country::IS_EEU, $content);
        $this->assertArrayHasKey(Country::ISO2, $content);
        $this->assertArrayHasKey(Country::ISO3, $content);

    }

    /**
     * @test
     */
    public function userWithoutLoginCanNotGetCountryLanguages()
    {
        $country = Country::factory()->has(CountryTranslation::factory(), 'translations')->create();
        $this->getJson(
            route('languages.index', $country)
        )->assertUnauthorized();
    }

    /**
     * @test
     */
    public function userWithoutPermissionCanNotGetCountryLanguages()
    {
        $this->actingAsUser();
        $country = Country::factory()->has(CountryTranslation::factory(), 'translations')->create();
        $this->getJson(
            route('languages.index', $country)
        )->assertForbidden();

    }

    /**
     * @test
     */
    public function userWithPermissionCanGetCountryLanguages()
    {
        $this->actingAsUserWithPermission(PermissionTitle::GET_ALL_COUNTRY_LANGUAGES);
        $random = rand(2, 5);
        $languages = Language::inRandomOrder()->take($random)->get();
        $country = Country::factory()->has(CountryTranslation::factory(), 'translations')->create();
        $country->languages()->sync($languages->pluck(Language::ID)->toArray());

        $response = $this->getJson(
            route('languages.index', $country)
        )->assertOk();

        $this->assertEquals($response->getOriginalContent()->count(), $random);

    }

    /**
     * @test
     */
    public function userWithPermissionCanStoreCountryLanguages()
    {
        $this->actingAsUserWithPermission(PermissionTitle::CREATE_COUNTRY_LANGUAGES);
        $random = rand(2, 5);
        $languages = Language::inRandomOrder()->take($random)->get();
        $country = Country::factory()->has(CountryTranslation::factory(), 'translations')->create();
        $country->languages()->sync($languages->pluck(Language::ID)->toArray());
        $newLanguage = Language::whereNotIn(Language::ID, $languages->pluck(Language::ID)->toArray())->first();

        $response = $this->postJson(
            route('languages.store', ['country' => $country->getId(), 'language' => $newLanguage->getId()])
        )->assertOk();


        $this->assertEquals($response->getOriginalContent()->count(), $random + 1);
        $this->assertTrue($response->getOriginalContent()->contains('id', $newLanguage->getId()));

    }

    /**
     * @test
     */
    public function userWithPermissionCanSyncCountryLanguages()
    {
        $this->actingAsUserWithPermission(PermissionTitle::UPDATE_COUNTRY_LANGUAGES);
        $random = rand(3, 5);
        $languages = Language::inRandomOrder()->take($random)->get();
        $country = Country::factory()->has(CountryTranslation::factory(), 'translations')->create();
        $country->languages()->sync($languages->pluck(Language::ID)->toArray());
        $newLanguages = Language::whereNotIn(Language::ID, $languages->pluck(Language::ID)->toArray())->take(2)->get();

        $response = $this->putJson(
            route('languages.sync',
                [
                    'country' => $country->getId(),
                    'language_ids' => $newLanguages->pluck(Language::ID)->toArray()
                ]
            ))->assertOk();

        $this->assertEquals($response->getOriginalContent()->count(), 2);

    }

    /**
     * @test
     */
    public function userWithPermissionCanDeleteCountryLanguages()
    {
        $this->actingAsUserWithPermission(PermissionTitle::DELETE_COUNTRY_LANGUAGES);
        $random = rand(2, 5);
        $languages = Language::inRandomOrder()->take($random)->get();
        $country = Country::factory()->has(CountryTranslation::factory(), 'translations')->create();
        $country->languages()->sync($languages->pluck(Language::ID)->toArray());
        $deletedLanguage = Language::whereIn(Language::ID, $languages->pluck(Language::ID)->toArray())->first();

        $response = $this->deleteJson(
            route('languages.destroy', ['country' => $country->getId(), 'language' => $deletedLanguage])
        )->assertOk();

        $this->assertFalse($response->getOriginalContent()->contains('id', $deletedLanguage->id));

    }

}
