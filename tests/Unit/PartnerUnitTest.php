<?php

namespace Tests\Unit;

use App\Interfaces\Models\SaleSystem\SaleSystemInterface;
use App\Models\File\File;
use App\Models\SaleSystem\SaleSystem;
use App\Models\SaleSystem\Partner;
use App\Models\User\User;
use Tests\TestCase;

class PartnerUnitTest extends TestCase
{
    /**
     * @test
     */
    public function createPartner()
    {
        $parent = Partner::factory()->create([Partner::PARENT_ID => null]);
        $user = User::factory()->create();
        $coach = User::factory()->create();
        $backIdentityCard = File::factory()->create();
        $frontIdentityCard = File::factory()->create();
        $businessCertification = File::factory()->create();

        $partner = Partner::factory()->make(
            [
                Partner::PARENT_ID => $parent->getId(),
                Partner::USER_ID => $user->getId(),
                Partner::BACK_IDENTITY_CARD_ID => $backIdentityCard->getId(),
                Partner::FRONT_IDENTITY_CARD_ID => $frontIdentityCard->getId(),
                Partner::BUSINESS_CERTIFICATION_ID => $businessCertification->getId(),
                Partner::COACH_ID => $coach->getId(),
            ]
        );
        $partnerCreated = Partner::createObject(
            [
                Partner::SALE_SYSTEM_ID => $partner->getNetworkId(),
                Partner::USER_ID => $partner->getUserId(),
                Partner::COACH_ID => $partner->getCoachId(),
                Partner::PARENT_ID => $partner->getParentId(),
                Partner::BACK_IDENTITY_CARD_ID => $partner->getBackIdentityCardId(),
                Partner::FRONT_IDENTITY_CARD_ID => $partner->getFrontIdentityCardId(),
                Partner::BUSINESS_CERTIFICATION_ID => $partner->getBusinessCertificationId(),
                Partner::MOBILE => $partner->getMobile(),
                Partner::BANK_NAME => $partner->getBankName(),
                Partner::IBAN => $partner->getIban(),
                Partner::DEFAULT_WARRANTY_DAYS => $partner->getDefaultWarrantyDays(),
                Partner::SWIFT => $partner->getSwift(),
                Partner::RECEIVE_VAT_RESPONSIBLE => $partner->getReceiveVatResponsible(),
                Partner::SEND_VAT_RESPONSIBLE => $partner->getSendVatResponsible(),
                Partner::ACTIVE_AUTO_BONUS => $partner->getActiveAutoBonus(),
                Partner::ACTIVE_TRAINING_BONUS => $partner->getActiveTrainingBonus(),
                Partner::POST_DELIVERY_FACTOR => $partner->getPostDeliveryFactor(),
                Partner::RECEIVE_COMMISSION => $partner->getReceiveCommission(),
                Partner::CAN_BUY => $partner->getCanBuy(),
                Partner::TRANSPORTATION_RATIO_PERCENTAGE => $partner->getTransportationRatioPercentage(),
                Partner::OVER_PERSONAL_TURNOVER => $partner->getOverPersonalTurnover(),
                Partner::CAN_SEE_DOWN_LINE => $partner->getCanSeeDownLine(),
                Partner::INHOUSE_SALE => $partner->getInhouseSale(),
                Partner::HAS_NETWORK => $partner->getHasNetwork(),
                Partner::HAS_BTOB => $partner->getHasBtob(),
                Partner::HAS_BTOC => $partner->getHasBtoc(),
                Partner::HAS_WAREHOUSE => $partner->getHasWarehouse(),
                Partner::HAS_DELIVERY => $partner->getHasDelivery(),
                Partner::WARRANTY_DAYS => $partner->getWarrantyDays(),
                Partner::MAX_CLIENT_ROOT => $partner->getMaxClientRoot(),
                Partner::CREATED_AT => $partner->getCreatedAt(),
                Partner::UPDATED_AT => $partner->getUpdatedAt(),
                Partner::IS_ACTIVE => $partner->getIsActive(),
                Partner::COUNTRY_ID => $partner->getCountryId(),
            ]
        );
        $this->assertEquals($partnerCreated->getNetworkId(), $partner->getNetworkId());
        $this->assertEquals($partnerCreated->getUserId(), $partner->getUserId());
        $this->assertEquals($partnerCreated->getMobile(), $partner->getMobile());
        $this->assertEquals($partnerCreated->getBankName(), $partner->getBankName());
        $this->assertEquals($partnerCreated->getIban(), $partner->getIban());
        $this->assertEquals($partnerCreated->getDefaultWarrantyDays(), $partner->getDefaultWarrantyDays());
        $this->assertEquals($partnerCreated->getSwift(), $partner->getSwift());
        $this->assertEquals($partnerCreated->getReceiveVatResponsible(), $partner->getReceiveVatResponsible());
        $this->assertEquals($partnerCreated->getSendVatResponsible(), $partner->getSendVatResponsible());
        $this->assertEquals($partnerCreated->getActiveAutoBonus(), $partner->getActiveAutoBonus());
        $this->assertEquals($partnerCreated->getActiveTrainingBonus(), $partner->getActiveTrainingBonus());
        $this->assertEquals($partnerCreated->getPostDeliveryFactor(), $partner->getPostDeliveryFactor());
        $this->assertEquals($partnerCreated->getReceiveCommission(), $partner->getReceiveCommission());
        $this->assertEquals($partnerCreated->getCanBuy(), $partner->getCanBuy());
        $this->assertEquals($partnerCreated->getTransportationRatioPercentage(), $partner->getTransportationRatioPercentage());
        $this->assertEquals($partnerCreated->getOverPersonalTurnover(), $partner->getOverPersonalTurnover());
        $this->assertEquals($partnerCreated->getCanSeeDownLine(), $partner->getCanSeeDownLine());
        $this->assertEquals($partnerCreated->getInhouseSale(), $partner->getInhouseSale());
        $this->assertEquals($partnerCreated->getHasNetwork(), $partner->getHasNetwork());
        $this->assertEquals($partnerCreated->getHasBtob(), $partner->getHasBtob());
        $this->assertEquals($partnerCreated->getHasBtoc(), $partner->getHasBtoc());
        $this->assertEquals($partnerCreated->getHasWarehouse(), $partner->getHasWarehouse());
        $this->assertEquals($partnerCreated->getHasDelivery(), $partner->getHasDelivery());
        $this->assertEquals($partnerCreated->getWarrantyDays(), $partner->getWarrantyDays());
        $this->assertEquals($partnerCreated->getMaxClientRoot(), $partner->getMaxClientRoot());
        $this->assertEquals($partnerCreated->getIsActive(), $partner->getIsActive());
        $this->assertEquals($partnerCreated->getCountryId(), $partner->getCountryId());
    }

    /**
     * @test
     */
    public function updatePartner()
    {
        $parent = Partner::factory()->create([Partner::PARENT_ID => null]);
        $user = User::factory()->create();
        $coach = User::factory()->create();
        $backIdentityCard = File::factory()->create();
        $frontIdentityCard = File::factory()->create();
        $businessCertification = File::factory()->create();

        $partner = Partner::factory()->make(
            [
                Partner::PARENT_ID => $parent->getId(),
                Partner::USER_ID => $user->getId(),
                Partner::BACK_IDENTITY_CARD_ID => $backIdentityCard->getId(),
                Partner::FRONT_IDENTITY_CARD_ID => $frontIdentityCard->getId(),
                Partner::BUSINESS_CERTIFICATION_ID => $businessCertification->getId(),
                Partner::COACH_ID => $coach->getId(),
            ]
        );
        $partnerExistence = Partner::factory()->create();
        $partnerUpdated = $partnerExistence->updateObject(
            [
                Partner::SALE_SYSTEM_ID => $partner->getNetworkId(),
                Partner::USER_ID => $partner->getUserId(),
                Partner::COACH_ID => $partner->getCoachId(),
                Partner::PARENT_ID => $partner->getParentId(),
                Partner::BACK_IDENTITY_CARD_ID => $partner->getBackIdentityCardId(),
                Partner::FRONT_IDENTITY_CARD_ID => $partner->getFrontIdentityCardId(),
                Partner::BUSINESS_CERTIFICATION_ID => $partner->getBusinessCertificationId(),
                Partner::MOBILE => $partner->getMobile(),
                Partner::BANK_NAME => $partner->getBankName(),
                Partner::IBAN => $partner->getIban(),
                Partner::DEFAULT_WARRANTY_DAYS => $partner->getDefaultWarrantyDays(),
                Partner::SWIFT => $partner->getSwift(),
                Partner::RECEIVE_VAT_RESPONSIBLE => $partner->getReceiveVatResponsible(),
                Partner::SEND_VAT_RESPONSIBLE => $partner->getSendVatResponsible(),
                Partner::ACTIVE_AUTO_BONUS => $partner->getActiveAutoBonus(),
                Partner::ACTIVE_TRAINING_BONUS => $partner->getActiveTrainingBonus(),
                Partner::POST_DELIVERY_FACTOR => $partner->getPostDeliveryFactor(),
                Partner::RECEIVE_COMMISSION => $partner->getReceiveCommission(),
                Partner::CAN_BUY => $partner->getCanBuy(),
                Partner::TRANSPORTATION_RATIO_PERCENTAGE => $partner->getTransportationRatioPercentage(),
                Partner::OVER_PERSONAL_TURNOVER => $partner->getOverPersonalTurnover(),
                Partner::CAN_SEE_DOWN_LINE => $partner->getCanSeeDownLine(),
                Partner::INHOUSE_SALE => $partner->getInhouseSale(),
                Partner::HAS_NETWORK => $partner->getHasNetwork(),
                Partner::HAS_BTOB => $partner->getHasBtob(),
                Partner::HAS_BTOC => $partner->getHasBtoc(),
                Partner::HAS_WAREHOUSE => $partner->getHasWarehouse(),
                Partner::HAS_DELIVERY => $partner->getHasDelivery(),
                Partner::WARRANTY_DAYS => $partner->getWarrantyDays(),
                Partner::MAX_CLIENT_ROOT => $partner->getMaxClientRoot(),
                Partner::CREATED_AT => $partner->getCreatedAt(),
                Partner::UPDATED_AT => $partner->getUpdatedAt(),
                Partner::IS_ACTIVE => $partner->getIsActive(),
                Partner::COUNTRY_ID => $partner->getCountryId(),
            ]
        );
        $this->assertEquals($partnerUpdated->getNetworkId(), $partner->getNetworkId());
        $this->assertEquals($partnerUpdated->getUserId(), $partner->getUserId());
        $this->assertEquals($partnerUpdated->getMobile(), $partner->getMobile());
        $this->assertEquals($partnerUpdated->getBankName(), $partner->getBankName());
        $this->assertEquals($partnerUpdated->getIban(), $partner->getIban());
        $this->assertEquals($partnerUpdated->getDefaultWarrantyDays(), $partner->getDefaultWarrantyDays());
        $this->assertEquals($partnerUpdated->getSwift(), $partner->getSwift());
        $this->assertEquals($partnerUpdated->getReceiveVatResponsible(), $partner->getReceiveVatResponsible());
        $this->assertEquals($partnerUpdated->getSendVatResponsible(), $partner->getSendVatResponsible());
        $this->assertEquals($partnerUpdated->getActiveAutoBonus(), $partner->getActiveAutoBonus());
        $this->assertEquals($partnerUpdated->getActiveTrainingBonus(), $partner->getActiveTrainingBonus());
        $this->assertEquals($partnerUpdated->getPostDeliveryFactor(), $partner->getPostDeliveryFactor());
        $this->assertEquals($partnerUpdated->getReceiveCommission(), $partner->getReceiveCommission());
        $this->assertEquals($partnerUpdated->getCanBuy(), $partner->getCanBuy());
        $this->assertEquals($partnerUpdated->getTransportationRatioPercentage(), $partner->getTransportationRatioPercentage());
        $this->assertEquals($partnerUpdated->getOverPersonalTurnover(), $partner->getOverPersonalTurnover());
        $this->assertEquals($partnerUpdated->getCanSeeDownLine(), $partner->getCanSeeDownLine());
        $this->assertEquals($partnerUpdated->getInhouseSale(), $partner->getInhouseSale());
        $this->assertEquals($partnerUpdated->getHasNetwork(), $partner->getHasNetwork());
        $this->assertEquals($partnerUpdated->getHasBtob(), $partner->getHasBtob());
        $this->assertEquals($partnerUpdated->getHasBtoc(), $partner->getHasBtoc());
        $this->assertEquals($partnerUpdated->getHasWarehouse(), $partner->getHasWarehouse());
        $this->assertEquals($partnerUpdated->getHasDelivery(), $partner->getHasDelivery());
        $this->assertEquals($partnerUpdated->getWarrantyDays(), $partner->getWarrantyDays());
        $this->assertEquals($partnerUpdated->getMaxClientRoot(), $partner->getMaxClientRoot());
        $this->assertEquals($partnerUpdated->getIsActive(), $partner->getIsActive());
        $this->assertEquals($partnerUpdated->getCountryId(), $partner->getCountryId());
    }
}
