<?php

namespace Tests\Feature;

use App\Constants\PermissionTitle;
use App\Models\Currency\Currency;
use Illuminate\Http\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class CurrencyTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function testUserCanSeeCurrencyList()
    {
        $this->actingAsUserWithPermission(PermissionTitle::GET_ALL_CURRENCIES);

        $this->getJson(
            route('currency.index'),
        )->assertStatus(Response::HTTP_OK);
    }

    /**
     * @test
     */
    public function testUserCantSeeCurrencyList()
    {
        $this->actingAsUser();

        $this->getJson(
            route('currency.index'),
        )->assertStatus(Response::HTTP_FORBIDDEN);
    }

    /**
     * @test
     */
    public function testUserCanSeeCurrencyWithId()
    {
        $this->actingAsUserWithPermission(PermissionTitle::GET_CURRENCY);

        $currency = Currency::factory()->create();

        $response = $this->getJson(
            route('currency.show', $currency->getId()),
        )->assertStatus(Response::HTTP_OK);

        $this->assertEquals($currency->getTitle(), $response->getOriginalContent()->getTitle());
        $this->assertEquals($currency->getRatio(), $response->getOriginalContent()->getRatio());
        $this->assertEquals($currency->getIsDefault(), $response->json('data.' . Currency::IS_DEFAULT));
        $this->assertEquals($currency->getSymbol(), $response->getOriginalContent()->getSymbol());
        $this->assertEquals($currency->getIso3(), $response->getOriginalContent()->getIso3());
    }

    /**
     * @test
     */
    public function testUserCantDeleteCurrency()
    {
        $currency = Currency::factory()->create();

        $this->actingAsUser();
        $this->getJson(
            route('currency.destroy', $currency),
        )->assertStatus(Response::HTTP_FORBIDDEN);
    }

    /**
     * @test
     */
    public function testUserCanDeleteCurrency()
    {
        $this->actingAsUserWithPermission(PermissionTitle::DELETE_CURRENCY);
        $currency = Currency::factory()->create();

        $this->deleteJson(
            route('currency.destroy', $currency),
        )->assertNoContent();

        $deletedCurrency = Currency::whereId($currency->getId())->first();
        $this->assertNull($deletedCurrency);
    }

    /**
     * @test
     */
    public function testUserCantDeleteCurrencyWithWrongId()
    {
        $this->actingAsUserWithPermission(PermissionTitle::DELETE_CURRENCY);
        $this->deleteJson(
            route('currency.destroy', 15),
        )->assertStatus(Response::HTTP_NOT_FOUND);;
    }

    /**
     * @test
     */
    public function testCurrencyCanCreate()
    {
        $this->actingAsUserWithPermission(PermissionTitle::CREATE_CURRENCY);

        $currency = Currency::factory()->make();
        $response = $this->postJson(route('currency.store'),
            [
                Currency::TITLE => $currency->getTitle(),
                Currency::RATIO => $currency->getRatio(),
                Currency::IS_DEFAULT => $currency->getIsDefault(),
                Currency::SYMBOL => $currency->getSymbol(),
                Currency::ISO3 => $currency->getIso3(),
            ]
        )->assertStatus(Response::HTTP_CREATED);

        $this->assertEquals($currency->getTitle(), $response->getOriginalContent()->getTitle());
        $this->assertEquals($currency->getRatio(), $response->getOriginalContent()->getRatio());
        $this->assertEquals($currency->getIsDefault(), $response->getOriginalContent()->getIsDefault());
        $this->assertEquals($currency->getSymbol(), $response->getOriginalContent()->getSymbol());
        $this->assertEquals($currency->getIso3(), $response->getOriginalContent()->getIso3());
        $response->assertStatus(Response::HTTP_CREATED);
    }

    /**
     * @test
     */
    public function testUserCantCreateCurrencyWithoutPermission()
    {
        $this->actingAsUser();
        $this->postJson(
            route('currency.store'),
        )->assertStatus(Response::HTTP_FORBIDDEN);
    }

    /**
     * @test
     */
    public function testCanNotCreateCurrencyCheckRequiredFieldParameter()
    {
        $this->actingAsUserWithPermission(PermissionTitle::CREATE_CURRENCY);

        $response = $this->postJson(
            route('currency.store'),
            []
        )->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        /** @var array $content */
        $content = $response->getOriginalContent()->toArray();
        $this->assertArrayHasKey(Currency::TITLE, $content);
        $this->assertArrayHasKey(Currency::RATIO, $content);
        $this->assertArrayHasKey(Currency::IS_DEFAULT, $content);
        $this->assertArrayHasKey(Currency::SYMBOL, $content);
        $this->assertArrayHasKey(Currency::ISO3, $content);
    }

    /**
     * @test
     */
    public function testCanNotCreateCurrencyCheckFieldParameter()
    {
        $this->actingAsUserWithPermission(PermissionTitle::CREATE_CURRENCY);

        $response = $this->postJson(
            route('currency.store'),
            [
                Currency::TITLE => $this->faker->numberBetween(0, 10000),
                Currency::RATIO => $this->faker->word,
                Currency::IS_DEFAULT => $this->faker->word,
                Currency::SYMBOL => $this->faker->numberBetween(0, 10000),
                Currency::ISO3 => strtoupper(Str::random(rand(5, 16))),
            ]
        )->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        /** @var array $content */
        $content = $response->getOriginalContent()->toArray();

        $this->assertArrayHasKey(Currency::TITLE, $content);
        $this->assertArrayHasKey(Currency::RATIO, $content);
        $this->assertArrayHasKey(Currency::IS_DEFAULT, $content);
        $this->assertArrayHasKey(Currency::SYMBOL, $content);
        $this->assertArrayHasKey(Currency::ISO3, $content);
    }

    /**
     * @test
     */
    public function testUserCantUpdateCurrencyWithoutPermission()
    {
        $this->actingAsUser();
        $currency = Currency::factory()->create();
        $this->putJson(
            route('currency.update', $currency->getId()),
        )->assertStatus(Response::HTTP_FORBIDDEN);
    }

    /**
     * @test
     */
    public function testUserCanUpdateCurrency()
    {
        $this->actingAsUserWithPermission(PermissionTitle::UPDATE_CURRENCY);
        $currency = Currency::factory()->create();

        $title = $this->faker->title;
        $ratio = $this->faker->randomFloat(2, 1, 100);
        $defult = $this->faker->boolean;
        $symbol = strtoupper(Str::random(rand(2, 15)));
        $iso3 = strtoupper(Str::random(rand(3, 3)));
        $response = $this->putJson(
            route('currency.update', $currency->getId()),
            [
                Currency::TITLE => $title,
                Currency::RATIO => $ratio,
                Currency::IS_DEFAULT => $defult,
                Currency::SYMBOL => $symbol,
                Currency::ISO3 => $iso3,
            ]
        )->assertStatus(Response::HTTP_OK);

        $this->assertEquals($title, $response->getOriginalContent()->getTitle());
        $this->assertEquals($ratio, $response->getOriginalContent()->getRatio());
        $this->assertEquals($defult, $response->getOriginalContent()->getIsDefault());
        $this->assertEquals($symbol, $response->getOriginalContent()->getSymbol());
        $this->assertEquals($iso3, $response->getOriginalContent()->getIso3());
    }

    /**
     * @test
     */
    public function testfilterCurrencyByHasTitle()
    {
        $this->actingAsUserWithPermission(PermissionTitle::GET_ALL_CURRENCIES);

        $firstCurrency = Currency::factory()->create();
        $secondCurrency = Currency::factory()->create([Currency::TITLE => 'tter']);

        $response = $this->getJson(route('currency.index') . '?title=' . $firstCurrency->getTitle())
            ->assertStatus(Response::HTTP_OK);

        $this->assertTrue(
            $response->getOriginalContent()->contains(Currency::TITLE, $firstCurrency->getTitle())
        );
        $this->assertFalse(
            $response->getOriginalContent()->contains(Currency::TITLE, $secondCurrency->getTitle())
        );
    }

    /**
     * @test
     */
    public function testfilterCurrencyByHasRatio()
    {
        $this->actingAsUserWithPermission(PermissionTitle::GET_ALL_CURRENCIES);

        $firstCurrency = Currency::factory()->create();
        $secondCurrency = Currency::factory()->create([Currency::RATIO => 25.64]);

        $response = $this->getJson(route('currency.index') . '?ratio=' . $firstCurrency->getRatio())
            ->assertStatus(Response::HTTP_OK);

        $this->assertTrue(
            $response->getOriginalContent()->contains(Currency::RATIO, $firstCurrency->getRatio())
        );
        $this->assertFalse(
            $response->getOriginalContent()->contains(Currency::RATIO, $secondCurrency->getRatio())
        );
    }

    /**
     * @test
     */
    public function testfilterCurrencyByHasIsDefault()
    {
        $this->actingAsUserWithPermission(PermissionTitle::GET_ALL_CURRENCIES);

        $firstCurrency = Currency::factory()->create([Currency::IS_DEFAULT => true]);
        $secondCurrency = Currency::factory()->create([Currency::IS_DEFAULT => false]);

        $response = $this->getJson(route('currency.index') . '?isDefault=' . $firstCurrency->getIsDefault())
            ->assertStatus(Response::HTTP_OK);

        $this->assertTrue(
            $response->getOriginalContent()->contains(Currency::IS_DEFAULT, $firstCurrency->getIsDefault())
        );
        $this->assertFalse(
            $response->getOriginalContent()->contains(Currency::IS_DEFAULT, $secondCurrency->getIsDefault())
        );
    }

    /**
     * @test
     */
    public function testfilterCurrencyByHasSymbol()
    {
        $this->actingAsUserWithPermission(PermissionTitle::GET_ALL_CURRENCIES);

        $firstCurrency = Currency::factory()->create();
        $secondCurrency = Currency::factory()->create([Currency::SYMBOL => 'dinar']);

        $response = $this->getJson(route('currency.index') . '?symbol=' . $firstCurrency->getSymbol())
            ->assertStatus(Response::HTTP_OK);

        $this->assertTrue(
            $response->getOriginalContent()->contains(Currency::SYMBOL, $firstCurrency->getSymbol())
        );
        $this->assertFalse(
            $response->getOriginalContent()->contains(Currency::SYMBOL, $secondCurrency->getSymbol())
        );
    }

    /**
     * @test
     */
    public function testfilterCurrencyByHasIso3()
    {
        $this->actingAsUserWithPermission(PermissionTitle::GET_ALL_CURRENCIES);

        $firstCurrency = Currency::factory()->create();
        $secondCurrency = Currency::factory()->create([Currency::ISO3 => 'IRP']);

        $response = $this->getJson(route('currency.index') . '?iso3=' . $firstCurrency->getIso3())
            ->assertStatus(Response::HTTP_OK);

        $this->assertTrue(
            $response->getOriginalContent()->contains(Currency::ISO3, $firstCurrency->getIso3())
        );
        $this->assertFalse(
            $response->getOriginalContent()->contains(Currency::SYMBOL, $secondCurrency->getIso3())
        );
    }

    /**
     * @test
     */
    public function testCanNotCreateCurrencyCheckUniqueTitle()
    {
        $this->actingAsUserWithPermission(PermissionTitle::CREATE_CURRENCY);
        $firstCurrency = Currency::factory()->create();
        $this->postJson(
            route('currency.store'),
            [
                Currency::TITLE => $firstCurrency->getTitle(),
                Currency::RATIO => $this->faker->word,
                Currency::IS_DEFAULT => $this->faker->word,
                Currency::SYMBOL => $this->faker->numberBetween(0, 10000),
                Currency::ISO3 => strtoupper(Str::random(rand(5, 16))),
            ]
        )->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * @test
     */
    public function testCanNotCreateCurrencyCheckUniqueIso3()
    {
        $this->actingAsUserWithPermission(PermissionTitle::CREATE_CURRENCY);
        $firstCurrency = Currency::factory()->create();
        $this->postJson(
            route('currency.store'),
            [
                Currency::TITLE => $this->faker->word,
                Currency::RATIO => $firstCurrency->getRatio(),
                Currency::IS_DEFAULT => $firstCurrency->getIsDefault(),
                Currency::SYMBOL => $this->faker->numberBetween(0, 10000),
                Currency::ISO3 => $firstCurrency->getIso3(),
            ]
        )->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * @test
     */
    public function testCanNotCreateCurrencyCheckUniqueSymbol()
    {
        $this->actingAsUserWithPermission(PermissionTitle::CREATE_CURRENCY);
        $firstCurrency = Currency::factory()->create();
        $this->postJson(
            route('currency.store'),
            [
                Currency::TITLE => $this->faker->word,
                Currency::RATIO => $firstCurrency->getRatio(),
                Currency::IS_DEFAULT => $firstCurrency->getIsDefault(),
                Currency::SYMBOL => $firstCurrency->getSymbol(),
                Currency::ISO3 => strtoupper(Str::random(rand(5, 16))),
            ]
        )->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * @test
     */
    public function testCanUserSelectIsDefaultCurrency()
    {
        $this->actingAsUserWithPermission(PermissionTitle::SET_DEFAULT_CURRENCY);

        $currency = Currency::factory()->create([Currency::IS_DEFAULT => false]);

        $isDefault = true;
        $response = $this->putJson(
            route('currency.default', $currency->getId())
        )->assertStatus(Response::HTTP_OK);

        $this->assertEquals($isDefault, $response->getOriginalContent()->getIsDefault());
    }

    /**
     * @test
     */
    public function testCanNotUserSelectIsDefaultCurrency()
    {
        $this->actingAsUserWithPermission(PermissionTitle::SET_DEFAULT_CURRENCY);

        $currency = Currency::factory()->create([Currency::IS_DEFAULT => false]);

        $response = $this->putJson(
            route('currency.default', $currency->getId())
        )->assertStatus(Response::HTTP_OK);

        $this->assertNotEquals($currency->getIsDefault(), $response->getOriginalContent()->getIsDefault());
    }
}
