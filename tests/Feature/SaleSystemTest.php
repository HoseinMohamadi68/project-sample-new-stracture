<?php

namespace Tests\Feature;

use App\Constants\PermissionTitle;
use App\Models\LocalizableModel;
use App\Models\SaleSystem\SaleSystem;
use App\Models\Translations\SaleSystemTranslation;
use App\Models\User\User;
use Database\Seeders\LanguageSeeder;
use Illuminate\Http\Response;
use Tests\TestCase;

class SaleSystemTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(LanguageSeeder::class);
    }

    /**
     * @test
     */
    public function testUnAuthorizedUserCantSeeSaleSystemList()
    {
        $response = $this->getJson(
            route('sale-systems.index'),
        );
        $response->assertUnauthorized();
    }

    /**
     * @test
     */
    public function testUserCanSeeSaleSystemList()
    {
        $this->actingAsUserWithPermission(PermissionTitle::GET_ALL_SALE_SYSTEMS);
        $response = $this->getJson(
            route('sale-systems.index'),
        );
        $response->assertOk();
    }

    /**
     * @test
     */
    public function testUserCantSeeSaleSystemListWithoutPermission()
    {
        $this->actingAsUser();
        $this->getJson(
            route('sale-systems.index'),
        )->assertForbidden();
    }

    /**
     * @test
     */
    public function testUserCanDeleteNetwork()
    {
        $this->actingAsUserWithPermission(PermissionTitle::DELETE_SALE_SYSTEM);
        $saleSystem = SaleSystem::factory()->create();

        $this->deleteJson(
            route('sale-systems.destroy', $saleSystem),
        )->assertNoContent();

        $deletedSaleSystem = SaleSystem::whereId($saleSystem->getId())->first();
        $this->assertNull($deletedSaleSystem);
    }

    /**
     * @test
     */
    public function testUserCantDeleteSaleSystemWithWrongId()
    {
        $this->actingAsUserWithPermission(PermissionTitle::DELETE_SALE_SYSTEM);
        $this->deleteJson(
            route('sale-systems.destroy', 15),
        )->assertNotFound();
    }

    /**
     * @test
     */
    public function testUserCantDeleteSaleSystemWithoutPermission()
    {
        $this->actingAsUser();
        $saleSystem = SaleSystem::factory()->create();
        $this->deleteJson(
            route('sale-systems.destroy', $saleSystem->getId()),
        )->assertForbidden();
    }

    /**
     * @test
     */
    public function testUnAuthorizedUserCantDeleteSaleSystem()
    {
        $saleSystem = SaleSystem::factory()->create();
        $this->deleteJson(
            route('sale-systems.destroy', $saleSystem->getId()),
        )->assertUnauthorized();
    }

    /**
     * @test
     */
    public function testUnAuthorizedUserCantSeeSaleSystem()
    {
        $saleSystem = SaleSystem::factory()->create();
        $this->getJson(
            route('sale-systems.show', $saleSystem->getId()),
        )->assertUnauthorized();
    }

    /**
     * @test
     */
    public function testUserCantSeeSaleSystemWithoutPermission()
    {
        $this->actingAsUser();
        $saleSystem = SaleSystem::factory()->create();
        $this->getJson(
            route('sale-systems.show', $saleSystem->getId()),
        )->assertForbidden();
    }

    /**
     * @test
     */
    public function testUserCantSeeSaleSystemWithWrongId()
    {
        $this->actingAsUserWithPermission(PermissionTitle::GET_SALE_SYSTEM);
        $this->getJson(
            route('sale-systems.show', 15),
        )->assertNotFound();
    }

    /**
     * @test
     */
    public function testUserCanSeeSaleSystemWithId()
    {
        $this->actingAsUserWithPermission(PermissionTitle::GET_SALE_SYSTEM);
        $saleSystem = SaleSystem::factory()->has(SaleSystemTranslation::factory(), 'translations')->create();

        $response = $this->getJson(
            route('sale-systems.show', $saleSystem->getId()),
        )->assertOk();

        $this->assertEquals(
            $response->getOriginalContent()->translations->first()->getName(),
            $saleSystem->translations->first()->getName()
        );
        $this->assertEquals(
            $response->getOriginalContent()->translations->first()->getDescription(),
            $saleSystem->translations->first()->getDescription()
        );
        $this->assertEquals($response->getOriginalContent()->getUserId(), $saleSystem->getUserId());
        $this->assertEquals($response->getOriginalContent()->getPhone(), $saleSystem->getPhone());
        $this->assertEquals($response->getOriginalContent()->getFax(), $saleSystem->getFax());
        $this->assertEquals((boolean)$response->getOriginalContent()->getHasBtob(), $saleSystem->getHasBtob());
        $this->assertEquals((boolean)$response->getOriginalContent()->getHasBtoc(), $saleSystem->getHasBtoc());
        $this->assertEquals((boolean)$response->getOriginalContent()->getHasDelivery(), $saleSystem->getHasDelivery());
        $this->assertEquals((boolean)$response->getOriginalContent()->getHasWarehouse(), $saleSystem->getHasWarehouse());
        $this->assertEquals((boolean)$response->getOriginalContent()->getHasNetwork(), $saleSystem->getHasNetwork());
        $this->assertEquals((boolean)$response->getOriginalContent()->getMaxClientRoot(), $saleSystem->getMaxClientRoot());
        $this->assertEquals((boolean)$response->getOriginalContent()->getWarrantyDays(), $saleSystem->getWarrantyDays());
    }

    /**
     * @test
     */
    public function testUnAuthorizedUserCantCreateSaleSystem()
    {
        $this->postJson(
            route('sale-systems.store'),
        )->assertUnauthorized();
    }

    /**
     * @test
     */
    public function testUserCantCreateSaleSystemWithoutPermission()
    {
        $this->actingAsUser();
        $this->postJson(
            route('sale-systems.store'),
        )->assertForbidden();
    }

    /**
     * @test
     */
    public function testUserCanCreateSaleSystem()
    {
        $this->actingAsUserWithPermission(PermissionTitle::CREATE_SALE_SYSTEM);
        $user = User::factory()->create();
        $saleSystem = SaleSystem::factory()->make();
        $translations = SaleSystemTranslation::factory()->make();

        $response = $this->postJson(
            route('sale-systems.store'),
            [
                SaleSystem::USER_ID => $user->getId(),
                SaleSystem::DOMAIN => $saleSystem->getDomain(),
                SaleSystem::REGISTER_NUMBER => $saleSystem->getRegisterNumber(),
                SaleSystem::REGISTER_OFFICE => $saleSystem->getRegisterOffice(),
                SaleSystem::PHONE => $saleSystem->getPhone(),
                SaleSystem::FAX => $saleSystem->getFax(),
                SaleSystem::HAS_NETWORK => $saleSystem->getHasNetwork(),
                SaleSystem::HAS_BTOB => $saleSystem->getHasBtob(),
                SaleSystem::HAS_BTOC => $saleSystem->getHasBtoc(),
                SaleSystem::HAS_WAREHOUSE => $saleSystem->getHasWarehouse(),
                SaleSystem::HAS_DELIVERY => $saleSystem->getHasDelivery(),
                SaleSystem::WARRANTY_DAYS => $saleSystem->getWarrantyDays(),
                SaleSystem::MAX_CLIENT_ROOT => $saleSystem->getMaxClientRoot(),
                SaleSystem::IS_ACTIVE => $saleSystem->getIsActive(),
                LocalizableModel::LOCALIZATION_KEY => [
                    [
                        SaleSystemTranslation::LOCALE => $translations->getLocale(),
                        SaleSystemTranslation::DESCRIPTION => $translations->getDescription(),
                        SaleSystemTranslation::NAME => $translations->getName(),
                    ]
                ]
            ]
        );
        $response->assertCreated();
        $this->assertEquals(
            $response->getOriginalContent()->translations->first()->getName(),
            $translations->getName()
        );
        $this->assertEquals(
            $response->getOriginalContent()->translations->first()->getDescription(),
            $translations->getDescription()
        );
        $this->assertEquals($user->getId(), $response->getOriginalContent()->getUserId());
        $this->assertEquals($saleSystem->getDomain(), $response->getOriginalContent()->getDomain());
        $this->assertEquals($saleSystem->getRegisterNumber(), $response->getOriginalContent()->getRegisterNumber());
        $this->assertEquals($saleSystem->getRegisterOffice(), $response->getOriginalContent()->getRegisterOffice());
        $this->assertEquals($saleSystem->getPhone(), $response->getOriginalContent()->getPhone());
        $this->assertEquals($saleSystem->getFax(), $response->getOriginalContent()->getFax());
        $this->assertEquals((boolean)$saleSystem->getHasNetwork(), $response->getOriginalContent()->getHasNetwork());
        $this->assertEquals((boolean)$saleSystem->getHasBtob(), $response->getOriginalContent()->getHasBtob());
        $this->assertEquals((boolean)$saleSystem->getHasBtoc(), $response->getOriginalContent()->getHasBtoc());
        $this->assertEquals((boolean)$saleSystem->getHasWarehouse(), $response->getOriginalContent()->getHasWarehouse());
        $this->assertEquals((boolean)$saleSystem->getHasDelivery(), $response->getOriginalContent()->getHasDelivery());
        $this->assertEquals($saleSystem->getWarrantyDays(), $response->getOriginalContent()->getWarrantyDays());
        $this->assertEquals($saleSystem->getMaxClientRoot(), $response->getOriginalContent()->getMaxClientRoot());
    }

    /**
     * @test
     */
    public function testUserCantCreateSaleSystemCheckRequiredFieldParameter()
    {
        $this->actingAsUserWithPermission(PermissionTitle::CREATE_SALE_SYSTEM);
        $response = $this->postJson(
            route('sale-systems.store'),
            []
        )->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        /** @var array $content */
        $content = $response->getOriginalContent()->toArray();
        $this->assertArrayHasKey(SaleSystem::USER_ID, $content);
        $this->assertArrayHasKey(SaleSystem::DOMAIN, $content);
        $this->assertArrayHasKey(SaleSystem::REGISTER_NUMBER, $content);
        $this->assertArrayHasKey(SaleSystem::REGISTER_OFFICE, $content);
        $this->assertArrayHasKey(SaleSystem::PHONE, $content);
        $this->assertArrayHasKey(SaleSystem::FAX, $content);
        $this->assertArrayHasKey(SaleSystem::HAS_NETWORK, $content);
        $this->assertArrayHasKey(SaleSystem::HAS_BTOB, $content);
        $this->assertArrayHasKey(SaleSystem::HAS_BTOC, $content);
        $this->assertArrayHasKey(SaleSystem::HAS_WAREHOUSE, $content);
        $this->assertArrayHasKey(SaleSystem::HAS_DELIVERY, $content);
        $this->assertArrayHasKey(SaleSystem::WARRANTY_DAYS, $content);
        $this->assertArrayHasKey(SaleSystem::MAX_CLIENT_ROOT, $content);
        $this->assertArrayHasKey(LocalizableModel::LOCALIZATION_KEY, $content);
    }

    /**
     * @test
     */
    public function testUserCantCreateSaleSystemCheckInvalidFieldParameter()
    {
        $this->actingAsUserWithPermission(PermissionTitle::CREATE_SALE_SYSTEM);
        $response = $this->postJson(
            route('sale-systems.store'),
            [
                SaleSystem::USER_ID => 99999999,
                SaleSystem::DOMAIN => 'http://www.test.test.co',
                SaleSystem::HAS_NETWORK => '*',
                SaleSystem::HAS_BTOB => 'v',
                SaleSystem::HAS_BTOC => 'a',
                SaleSystem::HAS_WAREHOUSE => '-1',
                SaleSystem::HAS_DELIVERY => -1,
                SaleSystem::WARRANTY_DAYS => 'a',
                SaleSystem::MAX_CLIENT_ROOT => 'a',
                LocalizableModel::LOCALIZATION_KEY => [
                    'xx' => [
                        SaleSystemTranslation::LOCALE => 'xx',
                        SaleSystemTranslation::NAME => true,
                        SaleSystemTranslation::DESCRIPTION => true,
                    ]
                ]
            ]
        )->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        /** @var array $content */
        $content = $response->getOriginalContent()->toArray();

        $this->assertArrayHasKey(LocalizableModel::LOCALIZATION_KEY . '.xx.' . SaleSystemTranslation::NAME, $content);
        $this->assertArrayHasKey(LocalizableModel::LOCALIZATION_KEY . '.xx.' . SaleSystemTranslation::DESCRIPTION, $content);
        $this->assertArrayHasKey(LocalizableModel::LOCALIZATION_KEY . '.xx.' . SaleSystemTranslation::LOCALE, $content);
        $this->assertArrayHasKey(SaleSystem::USER_ID, $content);
        $this->assertArrayHasKey(SaleSystem::DOMAIN, $content);
        $this->assertArrayHasKey(SaleSystem::REGISTER_NUMBER, $content);
        $this->assertArrayHasKey(SaleSystem::REGISTER_OFFICE, $content);
        $this->assertArrayHasKey(SaleSystem::PHONE, $content);
        $this->assertArrayHasKey(SaleSystem::FAX, $content);
        $this->assertArrayHasKey(SaleSystem::HAS_NETWORK, $content);
        $this->assertArrayHasKey(SaleSystem::HAS_BTOB, $content);
        $this->assertArrayHasKey(SaleSystem::HAS_BTOC, $content);
        $this->assertArrayHasKey(SaleSystem::HAS_WAREHOUSE, $content);
        $this->assertArrayHasKey(SaleSystem::HAS_DELIVERY, $content);
        $this->assertArrayHasKey(SaleSystem::WARRANTY_DAYS, $content);
        $this->assertArrayHasKey(SaleSystem::MAX_CLIENT_ROOT, $content);
    }

    /**
     * @test
     */
    public function testUserCantUpdateSaleSystemWithoutPermission()
    {
        $this->actingAsUser();
        $saleSystems = SaleSystem::factory()->create();
        $this->putJson(
            route('sale-systems.update', $saleSystems->getId()),
        )->assertForbidden();
    }

    /**
     * @test
     */
    public function testUserCanUpdateSaleSystem()
    {
        $this->actingAsUserWithPermission(PermissionTitle::UPDATE_SALE_SYSTEM);
        $user = User::factory()->create();
        $saleSystems = SaleSystem::factory()->has(SaleSystemTranslation::factory(), 'translations')->create();
        $updateTranslation = SaleSystemTranslation::factory()->make();

        $domain = 'google.com';
        $registerNumber = '111111';
        $registerOffice = 'test';
        $phone = '9123456789';
        $fax = '12345678912';
        $maxClientRoot = 5;
        $warrantyDays = 4;
        $description = 'this is a test.';
        $isActive = true;
        $response = $this->putJson(
            route('sale-systems.update', $saleSystems->getId()),
            [
                SaleSystem::USER_ID => $user->getId(),
                SaleSystem::DOMAIN => $domain,
                SaleSystem::REGISTER_NUMBER => $registerNumber,
                SaleSystem::REGISTER_OFFICE => $registerOffice,
                SaleSystem::PHONE => $phone,
                SaleSystem::FAX => $fax,
                SaleSystem::HAS_NETWORK => false,
                SaleSystem::HAS_BTOB => false,
                SaleSystem::HAS_BTOC => false,
                SaleSystem::HAS_WAREHOUSE => false,
                SaleSystem::HAS_DELIVERY => false,
                SaleSystem::WARRANTY_DAYS => $warrantyDays,
                SaleSystem::MAX_CLIENT_ROOT => $maxClientRoot,
                SaleSystem::IS_ACTIVE => $isActive,
                LocalizableModel::LOCALIZATION_KEY => [
                    [
                        SaleSystemTranslation::LOCALE => $updateTranslation->getLocale(),
                        SaleSystemTranslation::DESCRIPTION => $updateTranslation->getDescription(),
                        SaleSystemTranslation::NAME => $updateTranslation->getName(),
                    ]
                ]
            ]
        );

        $response->getOriginalContent()->load('translations');
        $response->assertOk();
        $this->assertEquals(
            $response->getOriginalContent()->translations->first()->getName(),
            $updateTranslation->getName()
        );
        $this->assertEquals(
            $response->getOriginalContent()->translations->first()->getDescription(),
            $updateTranslation->getDescription()
        );
        $this->assertEquals($user->getId(), $response->getOriginalContent()->getUserId());
        $this->assertEquals($domain, $response->getOriginalContent()->getDomain());
        $this->assertEquals($registerNumber, $response->getOriginalContent()->getRegisterNumber());
        $this->assertEquals($registerOffice, $response->getOriginalContent()->getRegisterOffice());
        $this->assertEquals($phone, $response->getOriginalContent()->getPhone());
        $this->assertEquals($fax, $response->getOriginalContent()->getFax());
        $this->assertEquals($maxClientRoot, $response->getOriginalContent()->getMaxClientRoot());
        $this->assertEquals($warrantyDays, $response->getOriginalContent()->getWarrantyDays());
        $this->assertFalse($response->getOriginalContent()->getHasBtob());
        $this->assertFalse($response->getOriginalContent()->getHasBtoc());
        $this->assertFalse($response->getOriginalContent()->getHasDelivery());
        $this->assertFalse($response->getOriginalContent()->getHasNetwork());
        $this->assertFalse($response->getOriginalContent()->getHasWarehouse());
    }

    /**
     * @test
     */
    public function testUserCantUpdateSaleSystemCheckRequiredFieldParameter()
    {
        $this->actingAsUserWithPermission(PermissionTitle::UPDATE_SALE_SYSTEM);
        $user = User::factory()->create();
        $saleSystem = SaleSystem::factory()->create();

        $response = $this->putJson(
            route('sale-systems.update', $saleSystem->getId()),
            []
        )->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        /** @var array $content */
        $content = $response->getOriginalContent()->toArray();
        $this->assertArrayHasKey(LocalizableModel::LOCALIZATION_KEY, $content);
        $this->assertArrayHasKey(SaleSystem::USER_ID, $content);
        $this->assertArrayHasKey(SaleSystem::DOMAIN, $content);
        $this->assertArrayHasKey(SaleSystem::REGISTER_NUMBER, $content);
        $this->assertArrayHasKey(SaleSystem::REGISTER_OFFICE, $content);
        $this->assertArrayHasKey(SaleSystem::PHONE, $content);
        $this->assertArrayHasKey(SaleSystem::FAX, $content);
        $this->assertArrayHasKey(SaleSystem::HAS_NETWORK, $content);
        $this->assertArrayHasKey(SaleSystem::HAS_BTOB, $content);
        $this->assertArrayHasKey(SaleSystem::HAS_BTOC, $content);
        $this->assertArrayHasKey(SaleSystem::HAS_WAREHOUSE, $content);
        $this->assertArrayHasKey(SaleSystem::HAS_DELIVERY, $content);
        $this->assertArrayHasKey(SaleSystem::WARRANTY_DAYS, $content);
        $this->assertArrayHasKey(SaleSystem::MAX_CLIENT_ROOT, $content);
    }

    /**
     * @test
     */
    public function testUserCantUpdateSaleSystemCheckInvalidFieldParameter()
    {
        $this->actingAsUserWithPermission(PermissionTitle::UPDATE_SALE_SYSTEM);
        User::factory()->create();
        $saleSystems = SaleSystem::factory()->create();

        $response = $this->putJson(
            route('sale-systems.update', $saleSystems->getId()),
            [
                SaleSystem::USER_ID => 99999999,
                SaleSystem::DOMAIN => 'http://www.test.test.co',
                SaleSystem::HAS_NETWORK => '*',
                SaleSystem::HAS_BTOB => 'v',
                SaleSystem::HAS_BTOC => 'a',
                SaleSystem::HAS_WAREHOUSE => '-1',
                SaleSystem::HAS_DELIVERY => -1,
                SaleSystem::WARRANTY_DAYS => 'a',
                SaleSystem::MAX_CLIENT_ROOT => 'a',
                LocalizableModel::LOCALIZATION_KEY => [
                    'xx' => [
                        SaleSystemTranslation::LOCALE => 'xx',
                        SaleSystemTranslation::NAME => true,
                        SaleSystemTranslation::DESCRIPTION => true,
                    ]
                ]
            ]
        )->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        /** @var array $content */
        $content = $response->getOriginalContent()->toArray();

        $this->assertArrayHasKey(SaleSystem::USER_ID, $content);
        $this->assertArrayHasKey(SaleSystem::DOMAIN, $content);
        $this->assertArrayHasKey(SaleSystem::REGISTER_NUMBER, $content);
        $this->assertArrayHasKey(SaleSystem::REGISTER_OFFICE, $content);
        $this->assertArrayHasKey(SaleSystem::PHONE, $content);
        $this->assertArrayHasKey(SaleSystem::FAX, $content);
        $this->assertArrayHasKey(SaleSystem::HAS_NETWORK, $content);
        $this->assertArrayHasKey(SaleSystem::HAS_BTOB, $content);
        $this->assertArrayHasKey(SaleSystem::HAS_BTOC, $content);
        $this->assertArrayHasKey(SaleSystem::HAS_WAREHOUSE, $content);
        $this->assertArrayHasKey(SaleSystem::HAS_DELIVERY, $content);
        $this->assertArrayHasKey(SaleSystem::WARRANTY_DAYS, $content);
        $this->assertArrayHasKey(SaleSystem::MAX_CLIENT_ROOT, $content);
        $this->assertArrayHasKey(LocalizableModel::LOCALIZATION_KEY . '.xx.' . SaleSystemTranslation::NAME, $content);
        $this->assertArrayHasKey(LocalizableModel::LOCALIZATION_KEY . '.xx.' . SaleSystemTranslation::DESCRIPTION, $content);
        $this->assertArrayHasKey(LocalizableModel::LOCALIZATION_KEY . '.xx.' . SaleSystemTranslation::LOCALE, $content);
    }

    /**
     * @test
     */
    public function filterSaleSystemByHasNetwork()
    {
        $this->actingAsUserWithPermission(PermissionTitle::GET_ALL_SALE_SYSTEMS);
        SaleSystem::factory()
            ->has(SaleSystemTranslation::factory(), 'translations')
            ->count(5)->create([SaleSystem::HAS_NETWORK => false]);
        $firstSaleSystem = SaleSystem::factory()
            ->has(SaleSystemTranslation::factory(), 'translations')
            ->create([SaleSystem::HAS_NETWORK => true]);
        $secondSaleSystem = SaleSystem::factory()
            ->has(SaleSystemTranslation::factory(), 'translations')
            ->create([SaleSystem::HAS_NETWORK => false]);
        $response = $this->getJson(route('sale-systems.index') . '?hasNetwork=true');
        $response->assertOk();

        $this->assertTrue(
            $response->getOriginalContent()->contains(SaleSystem::ID, $firstSaleSystem->getId())
        );
        $this->assertFalse(
            $response->getOriginalContent()->contains(SaleSystem::ID, $secondSaleSystem->getId())
        );
    }

    /**
     * @test
     */
    public function filterSaleSystemByIsActive()
    {
        $this->actingAsUserWithPermission(PermissionTitle::GET_ALL_SALE_SYSTEMS);
        SaleSystem::factory()
            ->has(SaleSystemTranslation::factory(), 'translations')
            ->count(5)->create([SaleSystem::IS_ACTIVE => true]);
        $firstSaleSystem = SaleSystem::factory()
            ->has(SaleSystemTranslation::factory(), 'translations')
            ->create([SaleSystem::IS_ACTIVE => true]);
        $secondSaleSystem = SaleSystem::factory()
            ->has(SaleSystemTranslation::factory(), 'translations')
            ->create([SaleSystem::IS_ACTIVE => false]);
        $response = $this->getJson(route('sale-systems.index') . '?active=true');
        $response->assertOk();
        $this->assertTrue(
            $response->getOriginalContent()->contains(SaleSystem::ID, $firstSaleSystem->getId())
        );
        $this->assertFalse(
            $response->getOriginalContent()->contains(SaleSystem::ID, $secondSaleSystem->getId())
        );
    }

    /**
     * @test
     */
    public function filterSaleSystemByHasBtob()
    {
        $this->actingAsUserWithPermission(PermissionTitle::GET_ALL_SALE_SYSTEMS);
        SaleSystem::factory()
            ->has(SaleSystemTranslation::factory(), 'translations')
            ->count(5)->create([SaleSystem::HAS_BTOB => false]);
        $firstSaleSystems = SaleSystem::factory()
            ->has(SaleSystemTranslation::factory(), 'translations')
            ->create([SaleSystem::HAS_BTOB => true]);
        $secondSaleSystems = SaleSystem::factory()
            ->has(SaleSystemTranslation::factory(), 'translations')
            ->create([SaleSystem::HAS_BTOB => false]);

        $response = $this->getJson(route('sale-systems.index') . '?hasBtob=true');
        $response->assertOk();

        $this->assertTrue(
            $response->getOriginalContent()->contains(SaleSystem::ID, $firstSaleSystems->getId())
        );
        $this->assertFalse(
            $response->getOriginalContent()->contains(SaleSystem::ID, $secondSaleSystems->getId())
        );
    }

    /**
     * @test
     */
    public function filterSaleSystemByHasBtoc()
    {
        $this->actingAsUserWithPermission(PermissionTitle::GET_ALL_SALE_SYSTEMS);
        SaleSystem::factory()->count(5)
            ->has(SaleSystemTranslation::factory(), 'translations')
            ->create([SaleSystem::HAS_BTOC => false]);
        $firstSaleSystem = SaleSystem::factory()
            ->has(SaleSystemTranslation::factory(), 'translations')
            ->create([SaleSystem::HAS_BTOC => true]);
        $secondSaleSystem = SaleSystem::factory()
            ->has(SaleSystemTranslation::factory(), 'translations')
            ->create([SaleSystem::HAS_BTOC => false]);
        $response = $this->getJson(route('sale-systems.index') . '?hasBtoc=true');
        $response->assertOk();

        $this->assertTrue(
            $response->getOriginalContent()->contains(SaleSystem::ID, $firstSaleSystem->getId())
        );
        $this->assertFalse(
            $response->getOriginalContent()->contains(SaleSystem::ID, $secondSaleSystem->getId())
        );
    }

    /**
     * @test
     */
    public function filterSaleSystemByHasDelivery()
    {
        $this->actingAsUserWithPermission(PermissionTitle::GET_ALL_SALE_SYSTEMS);
        SaleSystem::factory()
            ->has(SaleSystemTranslation::factory(), 'translations')
            ->count(5)->create([SaleSystem::HAS_DELIVERY => false]);
        $firstSaleSystem = SaleSystem::factory()
            ->has(SaleSystemTranslation::factory(), 'translations')
            ->create([SaleSystem::HAS_DELIVERY => true]);
        $secondSaleSystem = SaleSystem::factory()
            ->has(SaleSystemTranslation::factory(), 'translations')
            ->create([SaleSystem::HAS_DELIVERY => false]);
        $response = $this->getJson(route('sale-systems.index') . '?hasDelivery=true');
        $response->assertOk();

        $this->assertTrue(
            $response->getOriginalContent()->contains(SaleSystem::ID, $firstSaleSystem->getId())
        );
        $this->assertFalse(
            $response->getOriginalContent()->contains(SaleSystem::ID, $secondSaleSystem->getId())
        );
    }

    /**
     * @test
     */
    public function filterNeSaleSystemHasWarehouse()
    {
        $this->actingAsUserWithPermission(PermissionTitle::GET_ALL_SALE_SYSTEMS);
        SaleSystem::factory()
            ->has(SaleSystemTranslation::factory(), 'translations')
            ->count(5)->create([SaleSystem::HAS_WAREHOUSE => false]);
        $firstSaleSystem = SaleSystem::factory()
            ->has(SaleSystemTranslation::factory(), 'translations')
            ->create([SaleSystem::HAS_WAREHOUSE => true]);
        $secondSaleSystem = SaleSystem::factory()
            ->has(SaleSystemTranslation::factory(), 'translations')
            ->create([SaleSystem::HAS_WAREHOUSE => false]);
        $response = $this->getJson(route('sale-systems.index') . '?hasWarehouse=true');
        $response->assertOk();

        $this->assertTrue(
            $response->getOriginalContent()->contains(SaleSystem::ID, $firstSaleSystem->getId())
        );
        $this->assertFalse(
            $response->getOriginalContent()->contains(SaleSystem::ID, $secondSaleSystem->getId())
        );
    }

    /**
     * @test
     */
    public function filterSaleSystemByUserId()
    {
        $this->actingAsUserWithPermission(PermissionTitle::GET_ALL_SALE_SYSTEMS);
        $user = User::factory()->count(2)->create();
        SaleSystem::factory()
            ->has(SaleSystemTranslation::factory(), 'translations')
            ->count(5)->create([SaleSystem::USER_ID => $user->first()->getId()]);
        $firstSaleSystem = SaleSystem::factory()
            ->has(SaleSystemTranslation::factory(), 'translations')
            ->create([SaleSystem::USER_ID => $user->first()->getId()]);
        $secondSaleSystem = SaleSystem::factory()
            ->has(SaleSystemTranslation::factory(), 'translations')
            ->create([SaleSystem::USER_ID => $user->last()->getId()]);

        $response = $this->getJson(route('sale-systems.index') . '?userId=' . $user->first()->getId());
        $response->assertOk();

        $this->assertTrue(
            $response->getOriginalContent()->contains(SaleSystem::ID, $firstSaleSystem->getId())
        );
        $this->assertFalse(
            $response->getOriginalContent()->contains(SaleSystem::ID, $secondSaleSystem->getId())
        );
    }

    /**
     * @test
     */
    public function filterSaleSystemByMaxClientRoot()
    {
        $this->actingAsUserWithPermission(PermissionTitle::GET_ALL_SALE_SYSTEMS);
        SaleSystem::factory()
            ->has(SaleSystemTranslation::factory(), 'translations')
            ->count(5)->create([SaleSystem::MAX_CLIENT_ROOT => 3]);
        $firstSaleSystem = SaleSystem::factory()
            ->has(SaleSystemTranslation::factory(), 'translations')
            ->create([SaleSystem::MAX_CLIENT_ROOT => 3]);
        $secondSaleSystem = SaleSystem::factory()
            ->has(SaleSystemTranslation::factory(), 'translations')
            ->create([SaleSystem::MAX_CLIENT_ROOT => 5]);

        $response = $this->getJson(route('sale-systems.index') . '?maxClientRoot=3');
        $response->assertOk();

        $this->assertTrue(
            $response->getOriginalContent()->contains(SaleSystem::ID, $firstSaleSystem->getId())
        );
        $this->assertFalse(
            $response->getOriginalContent()->contains(SaleSystem::ID, $secondSaleSystem->getId())
        );
    }

    /**
     * @test
     */
    public function filterSaleSystemByWarrantyDays()
    {
        $this->actingAsUserWithPermission(PermissionTitle::GET_ALL_SALE_SYSTEMS);
        SaleSystem::factory()
            ->has(SaleSystemTranslation::factory(), 'translations')
            ->count(5)->create([SaleSystem::WARRANTY_DAYS => 3]);
        $firstSaleSystem = SaleSystem::factory()
            ->has(SaleSystemTranslation::factory(), 'translations')
            ->create([SaleSystem::WARRANTY_DAYS => 3]);
        $secondSaleSystem = SaleSystem::factory()
            ->has(SaleSystemTranslation::factory(), 'translations')
            ->create([SaleSystem::WARRANTY_DAYS => 5]);

        $response = $this->getJson(route('sale-systems.index') . '?warrantyDays=3');
        $response->assertOk();

        $this->assertTrue(
            $response->getOriginalContent()->contains(SaleSystem::ID, $firstSaleSystem->getId())
        );
        $this->assertFalse(
            $response->getOriginalContent()->contains(SaleSystem::ID, $secondSaleSystem->getId())
        );
    }

    /**
     * @test
     */
    public function filterSaleSystemByRegisterNumber()
    {
        $this->actingAsUserWithPermission(PermissionTitle::GET_ALL_SALE_SYSTEMS);
        $registerNumber = '918-12145422-45';
        SaleSystem::factory()
            ->has(SaleSystemTranslation::factory(), 'translations')
            ->count(5)->create([SaleSystem::REGISTER_NUMBER => $registerNumber]);
        $firstSaleSystem = SaleSystem::factory()
            ->has(SaleSystemTranslation::factory(), 'translations')
            ->create([SaleSystem::REGISTER_NUMBER => $registerNumber]);
        $secondSaleSystem = SaleSystem::factory()
            ->has(SaleSystemTranslation::factory(), 'translations')
            ->create([SaleSystem::REGISTER_NUMBER => '123']);

        $response = $this->getJson(route('sale-systems.index') . '?registerNumber=' . $registerNumber);
        $response->assertOk();

        $this->assertTrue(
            $response->getOriginalContent()->contains(SaleSystem::ID, $firstSaleSystem->getId())
        );
        $this->assertFalse(
            $response->getOriginalContent()->contains(SaleSystem::ID, $secondSaleSystem->getId())
        );
    }

    /**
     * @test
     */
    public function filterSaleSystemByRegisterOffice()
    {
        $this->actingAsUserWithPermission(PermissionTitle::GET_ALL_SALE_SYSTEMS);
        $registerOffice = 'test';
        SaleSystem::factory()
            ->has(SaleSystemTranslation::factory(), 'translations')
            ->count(5)->create([SaleSystem::REGISTER_OFFICE => $registerOffice]);
        $firstSaleSystem = SaleSystem::factory()
            ->has(SaleSystemTranslation::factory(), 'translations')
            ->create([SaleSystem::REGISTER_OFFICE => $registerOffice]);
        $secondSaleSystem = SaleSystem::factory()
            ->has(SaleSystemTranslation::factory(), 'translations')
            ->create([SaleSystem::REGISTER_OFFICE => '123']);

        $response = $this->getJson(route('sale-systems.index') . '?registerOffice=' . $registerOffice);
        $response->assertOk();

        $this->assertTrue(
            $response->getOriginalContent()->contains(SaleSystem::ID, $firstSaleSystem->getId())
        );
        $this->assertFalse(
            $response->getOriginalContent()->contains(SaleSystem::ID, $secondSaleSystem->getId())
        );
    }

    /**
     * @test
     */
    public function filterSaleSystemByPhone()
    {
        $this->actingAsUserWithPermission(PermissionTitle::GET_ALL_SALE_SYSTEMS);
        $phone = '+9812345678';
        SaleSystem::factory()
            ->has(SaleSystemTranslation::factory(), 'translations')
            ->count(5)->create([SaleSystem::PHONE => $phone]);
        $firstSaleSystem = SaleSystem::factory()
            ->has(SaleSystemTranslation::factory(), 'translations')
            ->create([SaleSystem::PHONE => $phone]);
        $secondSaleSystem = SaleSystem::factory()
            ->has(SaleSystemTranslation::factory(), 'translations')
            ->create([SaleSystem::PHONE => '+98123']);

        $response = $this->getJson(route('sale-systems.index') . '?phone=' . $phone);
        $response->assertOk();

        $this->assertTrue(
            $response->getOriginalContent()->contains(SaleSystem::ID, $firstSaleSystem->getId())
        );
        $this->assertFalse(
            $response->getOriginalContent()->contains(SaleSystem::ID, $secondSaleSystem->getId())
        );
    }

    /**
     * @test
     */
    public function filterSaleSystemByFax()
    {
        $this->actingAsUserWithPermission(PermissionTitle::GET_ALL_SALE_SYSTEMS);
        $fax = '+9812345678';
        SaleSystem::factory()
            ->has(SaleSystemTranslation::factory(), 'translations')
            ->count(5)->create([SaleSystem::FAX => $fax]);
        $firstSaleSystem = SaleSystem::factory()
            ->has(SaleSystemTranslation::factory(), 'translations')
            ->create([SaleSystem::FAX => $fax]);
        $secondSaleSystem = SaleSystem::factory()
            ->has(SaleSystemTranslation::factory(), 'translations')
            ->create([SaleSystem::FAX => '+98123']);

        $response = $this->getJson(route('sale-systems.index') . '?fax=' . $fax);
        $response->assertOk();

        $this->assertTrue(
            $response->getOriginalContent()->contains(SaleSystem::ID, $firstSaleSystem->getId())
        );
        $this->assertFalse(
            $response->getOriginalContent()->contains(SaleSystem::ID, $secondSaleSystem->getId())
        );
    }
}
