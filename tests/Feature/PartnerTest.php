<?php

namespace Tests\Feature;

use App\Constants\PermissionTitle;
use App\Models\File\File;
use App\Models\SaleSystem\SaleSystem;
use App\Models\SaleSystem\Partner;
use App\Models\User\User;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use Tests\TestCase;

class PartnerTest extends TestCase
{
    /**
     * @test
     */
    public function testUserCanSeePartnerList()
    {
        $mobile = '123456789';
        $iban = 'shdsdgfjsdghfjsdf';
        Partner::factory()->count(5)->create([Partner::MOBILE => $mobile, Partner::IBAN => $iban]);

        $this->actingAsUserWithPermission(PermissionTitle::GET_ALL_PARTNERS);
        $response = $this->getJson(
            route('partners.index'),
        );

        $response->assertOk();
        $this->assertStringContainsString($iban, $response->getContent());
        $this->assertStringContainsString($mobile, $response->getContent());
    }

    /**
     * @test
     */
    public function testUserCantSeePartnerList()
    {
        $this->actingAsUser();
        $this->getJson(
            route('partners.index'),
        )->assertStatus(Response::HTTP_FORBIDDEN);
    }

    /**
     * @test
     */
    public function testUserCantDeletePartner()
    {
        $this->actingAsUser();
        $this->getJson(
            route('partners.index'),
        )->assertStatus(Response::HTTP_FORBIDDEN);
    }

    /**
     * @test
     */
    public function testUserCanDeletePartner()
    {
        $this->actingAsUserWithPermission(PermissionTitle::DELETE_PARTNER);
        $partner = Partner::factory()->create();

        $this->deleteJson(
            route('partners.destroy', $partner),
        )->assertNoContent();

        $deletedPartner = Partner::whereId($partner->getId())->first();
        $this->assertNull($deletedPartner);
    }

    /**
     * @test
     */
    public function testUserCantDeletePartnerWithWrongId()
    {
        $this->actingAsUserWithPermission(PermissionTitle::DELETE_PARTNER);
        $this->deleteJson(
            route('partners.destroy', 15),
        )->assertNotFound();
    }

    /**
     * @test
     */
    public function testUserCantSeePartnerWithWrongId()
    {
        $this->actingAsUserWithPermission(PermissionTitle::GET_PARTNER);
        $this->getJson(
            route('partners.show', 15),
        )->assertNotFound();
    }

    /**
     * @test
     */
    public function testUserCanSeePartnerWithId()
    {
        $this->actingAsUserWithPermission(PermissionTitle::GET_PARTNER);
        $partner = Partner::factory()->create();

        $response = $this->getJson(
            route('partners.show', $partner->getId()),
        )->assertOk();
        $this->assertEquals($response->getOriginalContent()->getUserId(), $partner->getUserId());
        $this->assertEquals($response->getOriginalContent()->getLeftTree(), $partner->getLeftTree());
        $this->assertEquals($response->getOriginalContent()->getRightTree(), $partner->getRightTree());
        $this->assertEquals($response->getOriginalContent()->getMobile(), $partner->getMobile());
        $this->assertEquals($response->getOriginalContent()->getBankName(), $partner->getBankName());
        $this->assertEquals($response->getOriginalContent()->getIban(), $partner->getIban());
        $this->assertEquals($response->getOriginalContent()->getDefaultWarrantyDays(), $partner->getDefaultWarrantyDays());
        $this->assertEquals($response->getOriginalContent()->getSwift(), $partner->getSwift());
        $this->assertEquals((bool) $response->getOriginalContent()->getReceiveVatResponsible(), $partner->getReceiveVatResponsible());
        $this->assertEquals((bool) $response->getOriginalContent()->getSendVatResponsible(), $partner->getSendVatResponsible());
        $this->assertEquals((bool) $response->getOriginalContent()->getActiveAutoBonus(), $partner->getActiveAutoBonus());
        $this->assertEquals((bool) $response->getOriginalContent()->getActiveTrainingBonus(), $partner->getActiveTrainingBonus());
        $this->assertEquals((bool) $response->getOriginalContent()->getPostDeliveryFactor(), $partner->getPostDeliveryFactor());
        $this->assertEquals((bool) $response->getOriginalContent()->getReceiveCommission(), $partner->getReceiveCommission());
        $this->assertEquals((bool) $response->getOriginalContent()->getCanBuy(), $partner->getCanBuy());
        $this->assertEquals($response->getOriginalContent()->getTransportationRatioPercentage(), $partner->getTransportationRatioPercentage());
        $this->assertEquals((bool) $response->getOriginalContent()->getOverPersonalTurnover(), $partner->getOverPersonalTurnover());
        $this->assertEquals((bool) $response->getOriginalContent()->getCanSeeDownLine(), $partner->getCanSeeDownLine());
        $this->assertEquals((bool) $response->getOriginalContent()->getInhouseSale(), $partner->getInhouseSale());
        $this->assertEquals((bool) $response->getOriginalContent()->getHasNetwork(), $partner->getHasNetwork());
        $this->assertEquals((bool) $response->getOriginalContent()->getHasBtob(), $partner->getHasBtob());
        $this->assertEquals((bool) $response->getOriginalContent()->getHasBtoc(), $partner->getHasBtoc());
        $this->assertEquals((bool) $response->getOriginalContent()->getHasWarehouse(), $partner->getHasWarehouse());
        $this->assertEquals((bool) $response->getOriginalContent()->getHasDelivery(), $partner->getHasDelivery());
        $this->assertEquals($response->getOriginalContent()->getWarrantyDays(), $partner->getWarrantyDays());
        $this->assertEquals($response->getOriginalContent()->getMaxClientRoot(), $partner->getMaxClientRoot());
        $this->assertEquals($response->getOriginalContent()->getCreatedAt(), $partner->getCreatedAt());
        $this->assertEquals($response->getOriginalContent()->getUpdatedAt(), $partner->getUpdatedAt());
        $this->assertEquals((bool) $response->getOriginalContent()->getIsActive(), $partner->getIsActive());
        $this->assertEquals($response->getOriginalContent()->getCountryId(), $partner->getCountryId());
    }

    /**
     * @test
     */
    public function testUserCantCreatePartnerWithoutPermission()
    {
        $this->actingAsUser();
        $this->postJson(
            route('partners.store'),
        )->assertForbidden();
    }

    /**
     * @test
     */
    public function testUserCanCreatePartner()
    {
        $this->actingAsUserWithPermission(PermissionTitle::CREATE_PARTNER);
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
        $response = $this->postJson(
            route('partners.store'),
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
        $response->assertCreated();
        $this->assertEquals($response->getOriginalContent()->getNetworkId(), $partner->getNetworkId());
        $this->assertEquals($response->getOriginalContent()->getUserId(), $partner->getUserId());
        $this->assertEquals($response->getOriginalContent()->getMobile(), $partner->getMobile());
        $this->assertEquals($response->getOriginalContent()->getBankName(), $partner->getBankName());
        $this->assertEquals($response->getOriginalContent()->getIban(), $partner->getIban());
        $this->assertEquals($response->getOriginalContent()->getDefaultWarrantyDays(), $partner->getDefaultWarrantyDays());
        $this->assertEquals($response->getOriginalContent()->getSwift(), $partner->getSwift());
        $this->assertEquals($response->getOriginalContent()->getReceiveVatResponsible(), $partner->getReceiveVatResponsible());
        $this->assertEquals($response->getOriginalContent()->getSendVatResponsible(), $partner->getSendVatResponsible());
        $this->assertEquals($response->getOriginalContent()->getActiveAutoBonus(), $partner->getActiveAutoBonus());
        $this->assertEquals($response->getOriginalContent()->getActiveTrainingBonus(), $partner->getActiveTrainingBonus());
        $this->assertEquals($response->getOriginalContent()->getPostDeliveryFactor(), $partner->getPostDeliveryFactor());
        $this->assertEquals($response->getOriginalContent()->getReceiveCommission(), $partner->getReceiveCommission());
        $this->assertEquals($response->getOriginalContent()->getCanBuy(), $partner->getCanBuy());
        $this->assertEquals($response->getOriginalContent()->getTransportationRatioPercentage(), $partner->getTransportationRatioPercentage());
        $this->assertEquals($response->getOriginalContent()->getOverPersonalTurnover(), $partner->getOverPersonalTurnover());
        $this->assertEquals($response->getOriginalContent()->getCanSeeDownLine(), $partner->getCanSeeDownLine());
        $this->assertEquals($response->getOriginalContent()->getInhouseSale(), $partner->getInhouseSale());
        $this->assertEquals($response->getOriginalContent()->getHasNetwork(), $partner->getHasNetwork());
        $this->assertEquals($response->getOriginalContent()->getHasBtob(), $partner->getHasBtob());
        $this->assertEquals($response->getOriginalContent()->getHasBtoc(), $partner->getHasBtoc());
        $this->assertEquals($response->getOriginalContent()->getHasWarehouse(), $partner->getHasWarehouse());
        $this->assertEquals($response->getOriginalContent()->getHasDelivery(), $partner->getHasDelivery());
        $this->assertEquals($response->getOriginalContent()->getWarrantyDays(), $partner->getWarrantyDays());
        $this->assertEquals($response->getOriginalContent()->getMaxClientRoot(), $partner->getMaxClientRoot());
        $this->assertEquals($response->getOriginalContent()->getIsActive(), $partner->getIsActive());
        $this->assertEquals($response->getOriginalContent()->getCountryId(), $partner->getCountryId());

    }

    /**
     * @test
     */
    public function testUserCantCreatePartnerCheckRequiredFieldParameter()
    {
        $this->actingAsUserWithPermission(PermissionTitle::CREATE_PARTNER);
        $response = $this->postJson(
            route('partners.store'),
            []
        )->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        /** @var array $content */
        $content = $response->getOriginalContent()->toArray();
        $this->assertArrayHasKey(Partner::USER_ID, $content);
        $this->assertArrayHasKey(Partner::COACH_ID, $content);
        $this->assertArrayHasKey(Partner::FRONT_IDENTITY_CARD_ID, $content);
        $this->assertArrayHasKey(Partner::BACK_IDENTITY_CARD_ID, $content);
        $this->assertArrayHasKey(Partner::BUSINESS_CERTIFICATION_ID, $content);
        $this->assertArrayHasKey(Partner::MOBILE, $content);
        $this->assertArrayHasKey(Partner::BANK_NAME, $content);
        $this->assertArrayHasKey(Partner::DEFAULT_WARRANTY_DAYS, $content);
        $this->assertArrayHasKey(Partner::RECEIVE_VAT_RESPONSIBLE, $content);
        $this->assertArrayHasKey(Partner::SEND_VAT_RESPONSIBLE, $content);
        $this->assertArrayHasKey(Partner::ACTIVE_AUTO_BONUS, $content);
        $this->assertArrayHasKey(Partner::ACTIVE_TRAINING_BONUS, $content);
        $this->assertArrayHasKey(Partner::POST_DELIVERY_FACTOR, $content);
        $this->assertArrayHasKey(Partner::RECEIVE_COMMISSION, $content);
        $this->assertArrayHasKey(Partner::CAN_BUY, $content);
        $this->assertArrayHasKey(Partner::TRANSPORTATION_RATIO_PERCENTAGE, $content);
        $this->assertArrayHasKey(Partner::OVER_PERSONAL_TURNOVER, $content);
        $this->assertArrayHasKey(Partner::CAN_SEE_DOWN_LINE, $content);
        $this->assertArrayHasKey(Partner::INHOUSE_SALE, $content);
        $this->assertArrayHasKey(Partner::HAS_NETWORK, $content);
        $this->assertArrayHasKey(Partner::HAS_BTOB, $content);
        $this->assertArrayHasKey(Partner::HAS_BTOC, $content);
        $this->assertArrayHasKey(Partner::HAS_WAREHOUSE, $content);
        $this->assertArrayHasKey(Partner::HAS_DELIVERY, $content);
        $this->assertArrayHasKey(Partner::WARRANTY_DAYS, $content);
        $this->assertArrayHasKey(Partner::MAX_CLIENT_ROOT, $content);
    }

    /**
     * @test
     */
    public function testUserCantCreatePartnerCheckInvalidFieldParameter()
    {
        $this->actingAsUserWithPermission(PermissionTitle::CREATE_PARTNER);
        $response = $this->postJson(
            route('partners.store'),
            [
                Partner::USER_ID => 99999,
                Partner::COACH_ID => 99999,
                Partner::FRONT_IDENTITY_CARD_ID => 99999,
                Partner::BACK_IDENTITY_CARD_ID => 99999,
                Partner::BUSINESS_CERTIFICATION_ID => 99999,
                Partner::BANK_NAME => 1234,
                Partner::IBAN => 1324,
                Partner::DEFAULT_WARRANTY_DAYS => 'numeric',
                Partner::SWIFT => true,
                Partner::RECEIVE_VAT_RESPONSIBLE => -1,
                Partner::SEND_VAT_RESPONSIBLE => -1,
                Partner::ACTIVE_AUTO_BONUS => -1,
                Partner::ACTIVE_TRAINING_BONUS => -1,
                Partner::POST_DELIVERY_FACTOR => -1,
                Partner::RECEIVE_COMMISSION => -1,
                Partner::CAN_BUY => -1,
                Partner::TRANSPORTATION_RATIO_PERCENTAGE => 'numeric',
                Partner::OVER_PERSONAL_TURNOVER => -1,
                Partner::CAN_SEE_DOWN_LINE => -1,
                Partner::INHOUSE_SALE => -1,
                Partner::HAS_NETWORK => -1,
                Partner::HAS_BTOB => -1,
                Partner::HAS_BTOC => -1,
                Partner::HAS_WAREHOUSE => -1,
                Partner::HAS_DELIVERY => -1,
                Partner::WARRANTY_DAYS => 'numeric',
                Partner::MAX_CLIENT_ROOT => 'numeric',
            ]
        )->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        /** @var array $content */
        $content = $response->getOriginalContent()->toArray();
        $this->assertArrayHasKey(Partner::USER_ID, $content);
        $this->assertArrayHasKey(Partner::COACH_ID, $content);
        $this->assertArrayHasKey(Partner::FRONT_IDENTITY_CARD_ID, $content);
        $this->assertArrayHasKey(Partner::BACK_IDENTITY_CARD_ID, $content);
        $this->assertArrayHasKey(Partner::BUSINESS_CERTIFICATION_ID, $content);
        $this->assertArrayHasKey(Partner::BANK_NAME, $content);
        $this->assertArrayHasKey(Partner::DEFAULT_WARRANTY_DAYS, $content);
        $this->assertArrayHasKey(Partner::RECEIVE_VAT_RESPONSIBLE, $content);
        $this->assertArrayHasKey(Partner::SEND_VAT_RESPONSIBLE, $content);
        $this->assertArrayHasKey(Partner::ACTIVE_AUTO_BONUS, $content);
        $this->assertArrayHasKey(Partner::ACTIVE_TRAINING_BONUS, $content);
        $this->assertArrayHasKey(Partner::POST_DELIVERY_FACTOR, $content);
        $this->assertArrayHasKey(Partner::RECEIVE_COMMISSION, $content);
        $this->assertArrayHasKey(Partner::CAN_BUY, $content);
        $this->assertArrayHasKey(Partner::TRANSPORTATION_RATIO_PERCENTAGE, $content);
        $this->assertArrayHasKey(Partner::OVER_PERSONAL_TURNOVER, $content);
        $this->assertArrayHasKey(Partner::CAN_SEE_DOWN_LINE, $content);
        $this->assertArrayHasKey(Partner::INHOUSE_SALE, $content);
        $this->assertArrayHasKey(Partner::HAS_NETWORK, $content);
        $this->assertArrayHasKey(Partner::HAS_BTOB, $content);
        $this->assertArrayHasKey(Partner::HAS_BTOC, $content);
        $this->assertArrayHasKey(Partner::HAS_WAREHOUSE, $content);
        $this->assertArrayHasKey(Partner::HAS_DELIVERY, $content);
        $this->assertArrayHasKey(Partner::WARRANTY_DAYS, $content);
        $this->assertArrayHasKey(Partner::MAX_CLIENT_ROOT, $content);
    }

    /**
     * @test
     */
    public function testUserCantUpdatePartnerWithoutPermission()
    {
        $this->actingAsUser();
        $partner = Partner::factory()->create();
        $this->putJson(
            route('partners.update', $partner->getId()),
        )->assertForbidden();
    }

    /**
     * @test
     */
    public function testUserCanUpdatePartner()
    {
        $this->actingAsUserWithPermission(PermissionTitle::UPDATE_PARTNER);
        $parent = Partner::factory()->create([Partner::PARENT_ID => null]);
        $originPartner = Partner::factory()->create();
        $partner = Partner::factory()->make(
            [
                Partner::PARENT_ID => $parent->getId(),
            ]
        );
        $response = $this->putJson(
            route('partners.update', $originPartner->getId()),
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
        $response->assertOk();
        $this->assertEquals($response->getOriginalContent()->getNetworkId(), $partner->getNetworkId());
        $this->assertEquals($response->getOriginalContent()->getUserId(), $partner->getUserId());
        $this->assertEquals($response->getOriginalContent()->getMobile(), $partner->getMobile());
        $this->assertEquals($response->getOriginalContent()->getBankName(), $partner->getBankName());
        $this->assertEquals($response->getOriginalContent()->getIban(), $partner->getIban());
        $this->assertEquals($response->getOriginalContent()->getDefaultWarrantyDays(), $partner->getDefaultWarrantyDays());
        $this->assertEquals($response->getOriginalContent()->getSwift(), $partner->getSwift());
        $this->assertEquals($response->getOriginalContent()->getReceiveVatResponsible(), $partner->getReceiveVatResponsible());
        $this->assertEquals($response->getOriginalContent()->getSendVatResponsible(), $partner->getSendVatResponsible());
        $this->assertEquals($response->getOriginalContent()->getActiveAutoBonus(), $partner->getActiveAutoBonus());
        $this->assertEquals($response->getOriginalContent()->getActiveTrainingBonus(), $partner->getActiveTrainingBonus());
        $this->assertEquals($response->getOriginalContent()->getPostDeliveryFactor(), $partner->getPostDeliveryFactor());
        $this->assertEquals($response->getOriginalContent()->getReceiveCommission(), $partner->getReceiveCommission());
        $this->assertEquals($response->getOriginalContent()->getCanBuy(), $partner->getCanBuy());
        $this->assertEquals($response->getOriginalContent()->getTransportationRatioPercentage(), $partner->getTransportationRatioPercentage());
        $this->assertEquals($response->getOriginalContent()->getOverPersonalTurnover(), $partner->getOverPersonalTurnover());
        $this->assertEquals($response->getOriginalContent()->getCanSeeDownLine(), $partner->getCanSeeDownLine());
        $this->assertEquals($response->getOriginalContent()->getInhouseSale(), $partner->getInhouseSale());
        $this->assertEquals($response->getOriginalContent()->getHasNetwork(), $partner->getHasNetwork());
        $this->assertEquals($response->getOriginalContent()->getHasBtob(), $partner->getHasBtob());
        $this->assertEquals($response->getOriginalContent()->getHasBtoc(), $partner->getHasBtoc());
        $this->assertEquals($response->getOriginalContent()->getHasWarehouse(), $partner->getHasWarehouse());
        $this->assertEquals($response->getOriginalContent()->getHasDelivery(), $partner->getHasDelivery());
        $this->assertEquals($response->getOriginalContent()->getWarrantyDays(), $partner->getWarrantyDays());
        $this->assertEquals($response->getOriginalContent()->getMaxClientRoot(), $partner->getMaxClientRoot());
        $this->assertEquals($response->getOriginalContent()->getIsActive(), $partner->getIsActive());
        $this->assertEquals($response->getOriginalContent()->getCountryId(), $partner->getCountryId());
    }

    /**
     * @test
     */
    public function testUserCantUpdatePartnerCheckRequiredFieldParameter()
    {
        $this->actingAsUserWithPermission(PermissionTitle::UPDATE_PARTNER);
        User::factory()->create();
        $partner = Partner::factory()->create();

        $response = $this->putJson(
            route('partners.update', $partner->getId()),
            []
        );
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        /** @var array $content */
        $content = $response->getOriginalContent()->toArray();
        $this->assertArrayHasKey(Partner::USER_ID, $content);
        $this->assertArrayHasKey(Partner::COACH_ID, $content);
        $this->assertArrayHasKey(Partner::FRONT_IDENTITY_CARD_ID, $content);
        $this->assertArrayHasKey(Partner::BACK_IDENTITY_CARD_ID, $content);
        $this->assertArrayHasKey(Partner::BUSINESS_CERTIFICATION_ID, $content);
        $this->assertArrayHasKey(Partner::MOBILE, $content);
        $this->assertArrayHasKey(Partner::BANK_NAME, $content);
        $this->assertArrayHasKey(Partner::DEFAULT_WARRANTY_DAYS, $content);
        $this->assertArrayHasKey(Partner::RECEIVE_VAT_RESPONSIBLE, $content);
        $this->assertArrayHasKey(Partner::SEND_VAT_RESPONSIBLE, $content);
        $this->assertArrayHasKey(Partner::ACTIVE_AUTO_BONUS, $content);
        $this->assertArrayHasKey(Partner::ACTIVE_TRAINING_BONUS, $content);
        $this->assertArrayHasKey(Partner::POST_DELIVERY_FACTOR, $content);
        $this->assertArrayHasKey(Partner::RECEIVE_COMMISSION, $content);
        $this->assertArrayHasKey(Partner::CAN_BUY, $content);
        $this->assertArrayHasKey(Partner::TRANSPORTATION_RATIO_PERCENTAGE, $content);
        $this->assertArrayHasKey(Partner::OVER_PERSONAL_TURNOVER, $content);
        $this->assertArrayHasKey(Partner::CAN_SEE_DOWN_LINE, $content);
        $this->assertArrayHasKey(Partner::INHOUSE_SALE, $content);
        $this->assertArrayHasKey(Partner::HAS_NETWORK, $content);
        $this->assertArrayHasKey(Partner::HAS_BTOB, $content);
        $this->assertArrayHasKey(Partner::HAS_BTOC, $content);
        $this->assertArrayHasKey(Partner::HAS_WAREHOUSE, $content);
        $this->assertArrayHasKey(Partner::HAS_DELIVERY, $content);
        $this->assertArrayHasKey(Partner::WARRANTY_DAYS, $content);
        $this->assertArrayHasKey(Partner::MAX_CLIENT_ROOT, $content);
    }

    /**
     * @test
     */
    public function testUserCantUpdatePartnerCheckInvalidFieldParameter()
    {
        $this->actingAsUserWithPermission(PermissionTitle::UPDATE_PARTNER);
        User::factory()->create();
        $partner = Partner::factory()->create();

        $response = $this->putJson(
            route('partners.update', $partner->getId()),
            [
                Partner::USER_ID => 99999,
                Partner::COACH_ID => 99999,
                Partner::FRONT_IDENTITY_CARD_ID => 99999,
                Partner::BACK_IDENTITY_CARD_ID => 99999,
                Partner::BUSINESS_CERTIFICATION_ID => 99999,
                Partner::BANK_NAME => 1234,
                Partner::IBAN => 1324,
                Partner::DEFAULT_WARRANTY_DAYS => 'numeric',
                Partner::SWIFT => true,
                Partner::RECEIVE_VAT_RESPONSIBLE => -1,
                Partner::SEND_VAT_RESPONSIBLE => -1,
                Partner::ACTIVE_AUTO_BONUS => -1,
                Partner::ACTIVE_TRAINING_BONUS => -1,
                Partner::POST_DELIVERY_FACTOR => -1,
                Partner::RECEIVE_COMMISSION => -1,
                Partner::CAN_BUY => -1,
                Partner::TRANSPORTATION_RATIO_PERCENTAGE => 'numeric',
                Partner::OVER_PERSONAL_TURNOVER => -1,
                Partner::CAN_SEE_DOWN_LINE => -1,
                Partner::INHOUSE_SALE => -1,
                Partner::HAS_NETWORK => -1,
                Partner::HAS_BTOB => -1,
                Partner::HAS_BTOC => -1,
                Partner::HAS_WAREHOUSE => -1,
                Partner::HAS_DELIVERY => -1,
                Partner::WARRANTY_DAYS => 'numeric',
                Partner::MAX_CLIENT_ROOT => 'numeric',
            ]
        );
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        /** @var array $content */
        $content = $response->getOriginalContent()->toArray();
        /** @var array $content */
        $content = $response->getOriginalContent()->toArray();
        $this->assertArrayHasKey(Partner::USER_ID, $content);
        $this->assertArrayHasKey(Partner::COACH_ID, $content);
        $this->assertArrayHasKey(Partner::FRONT_IDENTITY_CARD_ID, $content);
        $this->assertArrayHasKey(Partner::BACK_IDENTITY_CARD_ID, $content);
        $this->assertArrayHasKey(Partner::BUSINESS_CERTIFICATION_ID, $content);
        $this->assertArrayHasKey(Partner::BANK_NAME, $content);
        $this->assertArrayHasKey(Partner::DEFAULT_WARRANTY_DAYS, $content);
        $this->assertArrayHasKey(Partner::RECEIVE_VAT_RESPONSIBLE, $content);
        $this->assertArrayHasKey(Partner::SEND_VAT_RESPONSIBLE, $content);
        $this->assertArrayHasKey(Partner::ACTIVE_AUTO_BONUS, $content);
        $this->assertArrayHasKey(Partner::ACTIVE_TRAINING_BONUS, $content);
        $this->assertArrayHasKey(Partner::POST_DELIVERY_FACTOR, $content);
        $this->assertArrayHasKey(Partner::RECEIVE_COMMISSION, $content);
        $this->assertArrayHasKey(Partner::CAN_BUY, $content);
        $this->assertArrayHasKey(Partner::TRANSPORTATION_RATIO_PERCENTAGE, $content);
        $this->assertArrayHasKey(Partner::OVER_PERSONAL_TURNOVER, $content);
        $this->assertArrayHasKey(Partner::CAN_SEE_DOWN_LINE, $content);
        $this->assertArrayHasKey(Partner::INHOUSE_SALE, $content);
        $this->assertArrayHasKey(Partner::HAS_NETWORK, $content);
        $this->assertArrayHasKey(Partner::HAS_BTOB, $content);
        $this->assertArrayHasKey(Partner::HAS_BTOC, $content);
        $this->assertArrayHasKey(Partner::HAS_WAREHOUSE, $content);
        $this->assertArrayHasKey(Partner::HAS_DELIVERY, $content);
        $this->assertArrayHasKey(Partner::WARRANTY_DAYS, $content);
        $this->assertArrayHasKey(Partner::MAX_CLIENT_ROOT, $content);
    }

    /**
     * @test
     */
    public function filterPartnerByIsActive()
    {
        $this->actingAsUserWithPermission(PermissionTitle::GET_ALL_PARTNERS);
        Partner::factory()->count(5)->create([Partner::IS_ACTIVE => true]);
        $firstPartner = Partner::factory()->create([Partner::IS_ACTIVE => true]);
        $secondPartner = Partner::factory()->create([Partner::IS_ACTIVE => false]);
        $response = $this->getJson(route('partners.index') . '?active=true');
        $response->assertOk();
        $this->assertTrue(
            $response->getOriginalContent()->contains(Partner::ID, $firstPartner->getId())
        );
        $this->assertFalse(
            $response->getOriginalContent()->contains(Partner::ID, $secondPartner->getId())
        );
    }

    /**
     * @test
     */
    public function filterPartnerByHasBtob()
    {
        $this->actingAsUserWithPermission(PermissionTitle::GET_ALL_PARTNERS);
        Partner::factory()->count(5)->create([Partner::HAS_BTOB => false]);
        $firstPartner = Partner::factory()->create([Partner::HAS_BTOB => true]);
        $secondPartner = Partner::factory()->create([Partner::HAS_BTOB => false]);
        $response = $this->getJson(route('partners.index') . '?hasBtob=true');
        $response->assertOk();

        $this->assertTrue(
            $response->getOriginalContent()->contains(Partner::ID, $firstPartner->getId())
        );
        $this->assertFalse(
            $response->getOriginalContent()->contains(Partner::ID, $secondPartner->getId())
        );
    }

    /**
     * @test
     */
    public function filterPartnerByHasBtoc()
    {
        $this->actingAsUserWithPermission(PermissionTitle::GET_ALL_PARTNERS);
        Partner::factory()->count(5)->create([Partner::HAS_BTOC => false]);
        $firstPartner = Partner::factory()->create([Partner::HAS_BTOC => true]);
        $secondPartner = Partner::factory()->create([Partner::HAS_BTOC => false]);
        $response = $this->getJson(route('partners.index') . '?hasBtoc=true');
        $response->assertOk();

        $this->assertTrue(
            $response->getOriginalContent()->contains(Partner::ID, $firstPartner->getId())
        );
        $this->assertFalse(
            $response->getOriginalContent()->contains(Partner::ID, $secondPartner->getId())
        );
    }

    /**
     * @test
     */
    public function filterPartnerByHasDelivery()
    {
        $this->actingAsUserWithPermission(PermissionTitle::GET_ALL_PARTNERS);
        Partner::factory()->count(5)->create([Partner::HAS_DELIVERY => false]);
        $firstPartner = Partner::factory()->create([Partner::HAS_DELIVERY => true]);
        $secondPartner = Partner::factory()->create([Partner::HAS_DELIVERY => false]);
        $response = $this->getJson(route('partners.index') . '?hasDelivery=true');
        $response->assertOk();

        $this->assertTrue(
            $response->getOriginalContent()->contains(Partner::ID, $firstPartner->getId())
        );
        $this->assertFalse(
            $response->getOriginalContent()->contains(Partner::ID, $secondPartner->getId())
        );
    }

    /**
     * @test
     */
    public function filterPartnerByHasWarehouse()
    {
        $this->actingAsUserWithPermission(PermissionTitle::GET_ALL_PARTNERS);
        Partner::factory()->count(5)->create([Partner::HAS_WAREHOUSE => false]);
        $firstPartner = Partner::factory()->create([Partner::HAS_WAREHOUSE => true]);
        $secondPartner = Partner::factory()->create([Partner::HAS_WAREHOUSE => false]);
        $response = $this->getJson(route('partners.index') . '?hasWarehouse=true');
        $response->assertOk();

        $this->assertTrue(
            $response->getOriginalContent()->contains(Partner::ID, $firstPartner->getId())
        );
        $this->assertFalse(
            $response->getOriginalContent()->contains(Partner::ID, $secondPartner->getId())
        );
    }

    /**
     * @test
     */
    public function filterPartnerByUserId()
    {
        $this->actingAsUserWithPermission(PermissionTitle::GET_ALL_PARTNERS);
        $user = User::factory()->count(2)->create();
        Partner::factory()->count(5)->create([Partner::USER_ID => $user->first()->getId()]);
        $firstPartner = Partner::factory()->create([Partner::USER_ID => $user->first()->getId()]);
        $secondPartner = Partner::factory()->create([Partner::USER_ID => $user->last()->getId()]);

        $response = $this->getJson(route('partners.index') . '?userId=' . $user->first()->getId());
        $response->assertOk();

        $this->assertTrue(
            $response->getOriginalContent()->contains(Partner::ID, $firstPartner->getId())
        );
        $this->assertFalse(
            $response->getOriginalContent()->contains(Partner::ID, $secondPartner->getId())
        );
    }

    /**
     * @test
     */
    public function filterPartnerByMaxClientRoot()
    {
        $this->actingAsUserWithPermission(PermissionTitle::GET_ALL_PARTNERS);
        Partner::factory()->count(5)->create([Partner::MAX_CLIENT_ROOT => 3]);
        $firstPartner = Partner::factory()->create([Partner::MAX_CLIENT_ROOT => 3]);
        $secondPartner = Partner::factory()->create([Partner::MAX_CLIENT_ROOT => 5]);

        $response = $this->getJson(route('partners.index') . '?maxClientRoot=3');
        $response->assertOk();

        $this->assertTrue(
            $response->getOriginalContent()->contains(Partner::ID, $firstPartner->getId())
        );
        $this->assertFalse(
            $response->getOriginalContent()->contains(Partner::ID, $secondPartner->getId())
        );
    }

    /**
     * @test
     */
    public function filterPartnerByWarrantyDays()
    {
        $this->actingAsUserWithPermission(PermissionTitle::GET_ALL_PARTNERS);
        Partner::factory()->count(5)->create([Partner::WARRANTY_DAYS => 3]);
        $firstPartner = Partner::factory()->create([Partner::WARRANTY_DAYS => 3]);
        $secondPartner = Partner::factory()->create([Partner::WARRANTY_DAYS => 5]);

        $response = $this->getJson(route('partners.index') . '?warrantyDays=3');
        $response->assertOk();

        $this->assertTrue(
            $response->getOriginalContent()->contains(Partner::ID, $firstPartner->getId())
        );
        $this->assertFalse(
            $response->getOriginalContent()->contains(Partner::ID, $secondPartner->getId())
        );
    }

    /**
     * @test
     */
    public function filterPartnerByMobile()
    {
        $this->actingAsUserWithPermission(PermissionTitle::GET_ALL_PARTNERS);
        $phone = '9812345678';
        Partner::factory()->count(5)->create([Partner::MOBILE => $phone]);
        $firstPartner = Partner::factory()->create([Partner::MOBILE => $phone]);
        $secondPartner = Partner::factory()->create([Partner::MOBILE => '11111111']);

        $response = $this->getJson(route('partners.index') . '?mobile=' . $phone);
        $response->assertOk();

        $this->assertTrue(
            $response->getOriginalContent()->contains(Partner::ID, $firstPartner->getId())
        );
        $this->assertFalse(
            $response->getOriginalContent()->contains(Partner::ID, $secondPartner->getId())
        );
    }

    /**
     * @test
     */
    public function filterPartnerByNetwork()
    {
        $this->actingAsUserWithPermission(PermissionTitle::GET_ALL_PARTNERS);
        $network1 = SaleSystem::factory()->create();
        $network2 = SaleSystem::factory()->create();
        Partner::factory()->count(5)->create([Partner::SALE_SYSTEM_ID => $network1->getId()]);
        $firstPartner = Partner::factory()->create([Partner::SALE_SYSTEM_ID => $network1->getId()]);
        $secondPartner = Partner::factory()->create([Partner::SALE_SYSTEM_ID => $network2]);

        $response = $this->getJson(route('partners.index') . '?networkId=' . $network1->getId());
        $response->assertOk();

        $this->assertTrue(
            $response->getOriginalContent()->contains(Partner::ID, $firstPartner->getId())
        );
        $this->assertFalse(
            $response->getOriginalContent()->contains(Partner::ID, $secondPartner->getId())
        );
    }
    /**
     * @test
     */
    public function filterPartnerByCoach()
    {
        $this->actingAsUserWithPermission(PermissionTitle::GET_ALL_PARTNERS);
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        Partner::factory()->count(5)->create([Partner::COACH_ID => $user1->getId()]);
        $firstPartner = Partner::factory()->create([Partner::COACH_ID => $user1->getId()]);
        $secondPartner = Partner::factory()->create([Partner::COACH_ID => $user2]);

        $response = $this->getJson(route('partners.index') . '?coachId=' . $user1->getId());
        $response->assertOk();

        $this->assertTrue(
            $response->getOriginalContent()->contains(Partner::ID, $firstPartner->getId())
        );
        $this->assertFalse(
            $response->getOriginalContent()->contains(Partner::ID, $secondPartner->getId())
        );
    }
}
