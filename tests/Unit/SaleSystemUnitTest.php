<?php

namespace Tests\Unit;

use App\Interfaces\Models\SaleSystem\SaleSystemInterface;
use App\Models\SaleSystem\SaleSystem;
use App\Models\User\User;
use Tests\TestCase;

class SaleSystemUnitTest extends TestCase
{
    /**
     * @test
     */
    public function createSaleSystem()
    {
        $network = SaleSystem::factory()->make();
        $createdNetwork = SaleSystem::createObject([
            SaleSystem::USER_ID => $network->getUserId(),
            SaleSystem::DOMAIN => $network->getDomain(),
            SaleSystem::REGISTER_NUMBER => $network->getRegisterNumber(),
            SaleSystem::REGISTER_OFFICE => $network->getRegisterOffice(),
            SaleSystem::PHONE => $network->getPhone(),
            SaleSystem::FAX => $network->getFax(),
            SaleSystem::HAS_NETWORK => $network->getHasNetwork(),
            SaleSystem::HAS_BTOB => $network->getHasBtob(),
            SaleSystem::HAS_BTOC => $network->getHasBtoc(),
            SaleSystem::HAS_WAREHOUSE => $network->getHasWarehouse(),
            SaleSystem::HAS_DELIVERY => $network->getHasDelivery(),
            SaleSystem::WARRANTY_DAYS => $network->getWarrantyDays(),
            SaleSystem::MAX_CLIENT_ROOT => $network->getMaxClientRoot(),
            SaleSystem::IS_ACTIVE => $network->getIsActive(),
        ]);
        $this->assertTrue($createdNetwork instanceof SaleSystemInterface);
        $this->assertEquals($network->getUserId(), $createdNetwork->getUserId());
        $this->assertEquals($network->getDomain(), $createdNetwork->getDomain());
        $this->assertEquals($network->getRegisterNumber(), $createdNetwork->getRegisterNumber());
        $this->assertEquals($network->getRegisterOffice(), $createdNetwork->getRegisterOffice());
        $this->assertEquals($network->getPhone(), $createdNetwork->getPhone());
        $this->assertEquals($network->getFax(), $createdNetwork->getFax());
        $this->assertEquals($network->getHasNetwork(), $createdNetwork->getHasNetwork());
        $this->assertEquals($network->getHasBtob(), $createdNetwork->getHasBtob());
        $this->assertEquals($network->getHasBtoc(), $createdNetwork->getHasBtoc());
        $this->assertEquals($network->getHasWarehouse(), $createdNetwork->getHasWarehouse());
        $this->assertEquals($network->getHasDelivery(), $createdNetwork->getHasDelivery());
        $this->assertEquals($network->getWarrantyDays(), $createdNetwork->getWarrantyDays());
        $this->assertEquals($network->getMaxClientRoot(), $createdNetwork->getMaxClientRoot());
        $this->assertEquals($network->getIsActive(), $createdNetwork->getIsActive());

        $this->assertDatabaseHas(
            SaleSystem::TABLE,
            [
                SaleSystem::USER_ID => $createdNetwork->getUserId(),
                SaleSystem::DOMAIN => $createdNetwork->getDomain(),
                SaleSystem::REGISTER_NUMBER => $createdNetwork->getRegisterNumber(),
                SaleSystem::REGISTER_OFFICE => $createdNetwork->getRegisterOffice(),
                SaleSystem::PHONE => $createdNetwork->getPhone(),
                SaleSystem::FAX => $createdNetwork->getFax(),
                SaleSystem::HAS_NETWORK => $createdNetwork->getHasNetwork(),
                SaleSystem::HAS_BTOB => $createdNetwork->getHasBtob(),
                SaleSystem::HAS_BTOC => $createdNetwork->getHasBtoc(),
                SaleSystem::HAS_WAREHOUSE => $createdNetwork->getHasWarehouse(),
                SaleSystem::HAS_DELIVERY => $createdNetwork->getHasDelivery(),
                SaleSystem::WARRANTY_DAYS => $createdNetwork->getWarrantyDays(),
                SaleSystem::MAX_CLIENT_ROOT => $createdNetwork->getMaxClientRoot(),
                SaleSystem::IS_ACTIVE => $createdNetwork->getIsActive(),
            ]
        );
    }

    /**
     * @test
     */
    public function updateSaleSystem()
    {
        $saleSystem = SaleSystem::factory()->create();
        $user = User::factory()->create();
        $fakeSaleSystem = SaleSystem::factory()->make();
        $updatedSaleSystem = $saleSystem->updateObject([
            SaleSystem::USER_ID => $user->getId(),
            SaleSystem::DOMAIN => $fakeSaleSystem->getDomain(),
            SaleSystem::REGISTER_NUMBER => $fakeSaleSystem->getRegisterNumber(),
            SaleSystem::REGISTER_OFFICE => $fakeSaleSystem->getRegisterOffice(),
            SaleSystem::PHONE => $fakeSaleSystem->getPhone(),
            SaleSystem::FAX => $fakeSaleSystem->getFax(),
            SaleSystem::HAS_NETWORK => $fakeSaleSystem->getHasNetwork(),
            SaleSystem::HAS_BTOB => $fakeSaleSystem->getHasBtob(),
            SaleSystem::HAS_BTOC => $fakeSaleSystem->getHasBtoc(),
            SaleSystem::HAS_WAREHOUSE => $fakeSaleSystem->getHasWarehouse(),
            SaleSystem::HAS_DELIVERY => $fakeSaleSystem->getHasDelivery(),
            SaleSystem::WARRANTY_DAYS => $fakeSaleSystem->getWarrantyDays(),
            SaleSystem::MAX_CLIENT_ROOT => $fakeSaleSystem->getMaxClientRoot(),
            SaleSystem::IS_ACTIVE => $fakeSaleSystem->getIsActive(),
        ]);

        $this->assertTrue($updatedSaleSystem instanceof SaleSystemInterface);
        $this->assertEquals($saleSystem->getId(), $updatedSaleSystem->getId());
        $this->assertEquals($user->getId(), $updatedSaleSystem->getUserId());
        $this->assertEquals($fakeSaleSystem->getDomain(), $updatedSaleSystem->getDomain());
        $this->assertEquals($fakeSaleSystem->getRegisterNumber(), $updatedSaleSystem->getRegisterNumber());
        $this->assertEquals($fakeSaleSystem->getRegisterOffice(), $updatedSaleSystem->getRegisterOffice());
        $this->assertEquals($fakeSaleSystem->getPhone(), $updatedSaleSystem->getPhone());
        $this->assertEquals($fakeSaleSystem->getFax(), $updatedSaleSystem->getFax());
        $this->assertEquals($fakeSaleSystem->getHasNetwork(), $updatedSaleSystem->getHasNetwork());
        $this->assertEquals($fakeSaleSystem->getHasBtob(), $updatedSaleSystem->getHasBtob());
        $this->assertEquals($fakeSaleSystem->getHasBtoc(), $updatedSaleSystem->getHasBtoc());
        $this->assertEquals($fakeSaleSystem->getHasWarehouse(), $updatedSaleSystem->getHasWarehouse());
        $this->assertEquals($fakeSaleSystem->getHasDelivery(), $updatedSaleSystem->getHasDelivery());
        $this->assertEquals($fakeSaleSystem->getWarrantyDays(), $updatedSaleSystem->getWarrantyDays());
        $this->assertEquals($fakeSaleSystem->getMaxClientRoot(), $updatedSaleSystem->getMaxClientRoot());
        $this->assertEquals($fakeSaleSystem->getIsActive(), $updatedSaleSystem->getIsActive());
        $this->assertDatabaseHas(
            SaleSystem::TABLE,
            [
                SaleSystem::USER_ID => $updatedSaleSystem->getUserId(),
                SaleSystem::DOMAIN => $updatedSaleSystem->getDomain(),
                SaleSystem::REGISTER_NUMBER => $updatedSaleSystem->getRegisterNumber(),
                SaleSystem::REGISTER_OFFICE => $updatedSaleSystem->getRegisterOffice(),
                SaleSystem::PHONE => $updatedSaleSystem->getPhone(),
                SaleSystem::FAX => $updatedSaleSystem->getFax(),
                SaleSystem::HAS_NETWORK => $updatedSaleSystem->getHasNetwork(),
                SaleSystem::HAS_BTOB => $updatedSaleSystem->getHasBtob(),
                SaleSystem::HAS_BTOC => $updatedSaleSystem->getHasBtoc(),
                SaleSystem::HAS_WAREHOUSE => $updatedSaleSystem->getHasWarehouse(),
                SaleSystem::HAS_DELIVERY => $updatedSaleSystem->getHasDelivery(),
                SaleSystem::WARRANTY_DAYS => $updatedSaleSystem->getWarrantyDays(),
                SaleSystem::MAX_CLIENT_ROOT => $updatedSaleSystem->getMaxClientRoot(),
                SaleSystem::IS_ACTIVE => $updatedSaleSystem->getIsActive(),
            ]
        );
    }
}
