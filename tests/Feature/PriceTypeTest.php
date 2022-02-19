<?php

namespace Tests\Feature;

use App\Constants\PermissionTitle;
use App\Models\LocalizableModel;
use App\Models\Price\PriceType;
use App\Models\Translations\PriceTypeTranslation;
use Database\Seeders\LanguageSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class PriceTypeTest extends TestCase
{
    use RefreshDatabase;
    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(LanguageSeeder::class);
    }

    /**
     * @test
     */
    public function testUserCanSeePriceTypeList()
    {
        $this->actingAsUserWithPermission(PermissionTitle::GET_ALL_PRICETYPES);

       $this->getJson(
            route('price-type.index'),
        )->assertStatus(Response::HTTP_OK);
    }

    /**
     * @test
     */
    public function testUserCantSeePriceTypeList()
    {
        $this->actingAsUser();

        $this->getJson(
            route('price-type.index'),
        )->assertStatus(Response::HTTP_FORBIDDEN);
    }

    /**
     * @test
     */
    public function testUserCanSeePriceTypeWithId()
    {
        $this->actingAsUserWithPermission(PermissionTitle::GET_PRICETYPE);

        $priceType = PriceType::factory()->has(PriceTypeTranslation::factory(), 'translations')->create();

        $response = $this->getJson(
            route('price-type.show', $priceType->getId()),
        )->assertStatus(Response::HTTP_OK);

        $this->assertEquals($priceType->getName(), $response->getOriginalContent()->getName());
    }

    /**
     * @test
     */
    public function testUserCantDeletePriceType()
    {
        $priceType = PriceType::factory()->create();

        $this->actingAsUser();
        $this->getJson(
            route('price-type.destroy', $priceType),
        )->assertStatus(Response::HTTP_FORBIDDEN);
    }

    /**
     * @test
     */
    public function testUserCanDeletePriceType()
    {
        $this->actingAsUserWithPermission(PermissionTitle::DELETE_PRICETYPE);
        $priceType = PriceType::factory()->create();

        $this->deleteJson(
            route('price-type.destroy', $priceType),
        )->assertNoContent();

        $deletedPriceType = PriceType::whereId($priceType->getId())->first();
        $this->assertNull($deletedPriceType);
    }

    /**
     * @test
     */
    public function testUserCantDeletePriceTypeWithWrongId()
    {
        $this->actingAsUserWithPermission(PermissionTitle::DELETE_PRICETYPE);
        $this->deleteJson(
            route('price-type.destroy', 15),
        )->assertStatus(Response::HTTP_NOT_FOUND);;
    }

    /**
     * @test
     */
    public function testPriceTypeCanCreate()
    {
        $this->actingAsUserWithPermission(PermissionTitle::CREATE_PRICETYPE);

        $priceTypeTranslations = PriceTypeTranslation::factory()->make();
        $response = $this->postJson(route('price-type.store'),
            [

                LocalizableModel::LOCALIZATION_KEY => [
                    $priceTypeTranslations->getLocale() => [
                        PriceTypeTranslation::LOCALE => $priceTypeTranslations->getLocale(),
                        PriceTypeTranslation::NAME => $priceTypeTranslations->getName(),
                    ]
                ]
            ]
        )->assertStatus(Response::HTTP_CREATED);

        $this->assertEquals($response->getOriginalContent()->translations->first()->getName(),$priceTypeTranslations->getName());
        $response->assertStatus(Response::HTTP_CREATED);
    }

    /**
     * @test
     */
    public function testUserCantCreatePriceTypeWithoutPermission()
    {
        $this->actingAsUser();
        $this->postJson(
            route('price-type.store'),
        )->assertStatus(Response::HTTP_FORBIDDEN);
    }

    /**
     * @test
     */
    public function testCanNotCreatePriceTypeCheckRequiredFieldParameter()
    {
        $this->actingAsUserWithPermission(PermissionTitle::CREATE_PRICETYPE);

        $response = $this->postJson(
            route('price-type.store'),
            []
        )->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        /** @var array $content */
        $priceType = $response->getOriginalContent()->toArray();

        $this->assertArrayHasKey(LocalizableModel::LOCALIZATION_KEY, $priceType);
    }

    /**
     * @test
     */
    public function testCanNotCreatePriceTypeCheckFieldParameter()
    {
        $this->actingAsUserWithPermission(PermissionTitle::CREATE_PRICETYPE);

        $response = $this->postJson(
            route('price-type.store'),
            [
                LocalizableModel::LOCALIZATION_KEY => [
                    'lang' => [
                        PriceTypeTranslation::LOCALE => 'lang',
                        PriceTypeTranslation::NAME => true,
                    ]
            ]
    ]
        )->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        /** @var array $content */
        $content = $response->getOriginalContent()->toArray();

        $this->assertArrayHasKey(LocalizableModel::LOCALIZATION_KEY . '.lang.' . PriceTypeTranslation::NAME, $content);
        $this->assertArrayHasKey(LocalizableModel::LOCALIZATION_KEY . '.lang.' . PriceTypeTranslation::LOCALE, $content);
    }

    /**
     * @test
     */
    public function testUserCantUpdatePriceTypeWithoutPermission()
    {
        $this->actingAsUser();
        $priceType = PriceType::factory()->create();
        $this->putJson(
            route('price-type.update', $priceType->getId()),
        )->assertStatus(Response::HTTP_FORBIDDEN);
    }

    /**
     * @test
     */
    public function testUserCanUpdatePriceType()
    {
        $this->actingAsUserWithPermission(PermissionTitle::UPDATE_PRICETYPE);
        $priceType = PriceType::factory()->has(PriceTypeTranslation::factory(), 'translations')->create();

        $updateTranslation = PriceTypeTranslation::factory()->make();

        $response = $this->putJson(
            route('price-type.update', $priceType->getId()),
            [
                LocalizableModel::LOCALIZATION_KEY => [
                    [
                        PriceTypeTranslation::LOCALE => $updateTranslation->getLocale(),
                        PriceTypeTranslation::NAME => $updateTranslation->getName(),
                    ]
                ]
            ]
        );
        $response->getOriginalContent()->load('translations');
        $response->assertStatus(Response::HTTP_OK);

        $this->assertEquals(
            $response->getOriginalContent()->translations->first()->getName(),
            $updateTranslation->getName()
        );
        $this->assertEquals(
            $response->getOriginalContent()->translations->first()->getLocale(),
            $updateTranslation->getLocale()
        );
    }

    /**
     * @test
     */
    public function testCanNotCreatePriceTypeCheckUniqueName()
    {
        $this->actingAsUserWithPermission(PermissionTitle::CREATE_PRICETYPE);
        $priceType = PriceType::factory()->has(PriceTypeTranslation::factory(), 'translations')->create();

        $this->postJson(
            route('price-type.store'),
            [
                LocalizableModel::LOCALIZATION_KEY => [
                    [
                        PriceTypeTranslation::NAME => $priceType->getName(),
                    ]
                ]
            ]
        )->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
