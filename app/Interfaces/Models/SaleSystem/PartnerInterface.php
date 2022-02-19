<?php

namespace App\Interfaces\Models\SaleSystem;

use App\Interfaces\Models\BaseModelInterface;
use App\Interfaces\Traits\HasActiveAutoBonusInterface;
use App\Interfaces\Traits\HasActiveTrainingBonusInterface;
use App\Interfaces\Traits\HasBackIdentityCardIdInterface;
use App\Interfaces\Traits\HasBankNameInterface;
use App\Interfaces\Traits\HasBtobInterface;
use App\Interfaces\Traits\HasBtocInterface;
use App\Interfaces\Traits\HasBusinessCertificationIdInterface;
use App\Interfaces\Traits\HasCanBuyInterface;
use App\Interfaces\Traits\HasCanSeeDownLineInterface;
use App\Interfaces\Traits\HasCoachIdInterface;
use App\Interfaces\Traits\HasCountryIdInterface;
use App\Interfaces\Traits\HasDefaultWarrantyDaysInterface;
use App\Interfaces\Traits\HasDeliveryInterface;
use App\Interfaces\Traits\HasFrontIdentityCardIdInterface;
use App\Interfaces\Traits\HasIbanInterface;
use App\Interfaces\Traits\HasIsActiveInterface;
use App\Interfaces\Traits\HasMaxClientRootInterface;
use App\Interfaces\Traits\HasMobileInterface;
use App\Interfaces\Traits\HasSaleSystemIdInterface;
use App\Interfaces\Traits\HasNetworkInterface;
use App\Interfaces\Traits\HasOverPersonalTurnoverInterface;
use App\Interfaces\Traits\HasPostDeliveryFactorInterface;
use App\Interfaces\Traits\HasReceiveCommissionInterface;
use App\Interfaces\Traits\HasReceiveVatResponsibleInterface;
use App\Interfaces\Traits\HasSendVatResponsibleInterface;
use App\Interfaces\Traits\HasSwiftInterface;
use App\Interfaces\Traits\HasTransportationRatioPercentageInterface;
use App\Interfaces\Traits\HasUserIdInterface;
use App\Interfaces\Traits\HasWareHouseInterface;
use App\Interfaces\Traits\HasWarrantyDaysInterface;

interface PartnerInterface extends
    BaseModelInterface,
    HasUserIdInterface,
    HasSaleSystemIdInterface,
    HasCoachIdInterface,
    HasFrontIdentityCardIdInterface,
    HasBackIdentityCardIdInterface,
    HasBusinessCertificationIdInterface,
    HasCountryIdInterface,
    HasMobileInterface,
    HasBankNameInterface,
    HasIbanInterface,
    HasDefaultWarrantyDaysInterface,
    HasSwiftInterface,
    HasReceiveVatResponsibleInterface,
    HasSendVatResponsibleInterface,
    HasActiveAutoBonusInterface,
    HasActiveTrainingBonusInterface,
    HasPostDeliveryFactorInterface,
    HasReceiveCommissionInterface,
    HasCanBuyInterface,
    HasTransportationRatioPercentageInterface,
    HasOverPersonalTurnoverInterface,
    HasCanSeeDownLineInterface,
    HasNetworkInterface,
    HasBtobInterface,
    HasBtocInterface,
    HasDeliveryInterface,
    HasWarehouseInterface,
    HasWarrantyDaysInterface,
    HasMaxClientRootInterface,
    HasIsActiveInterface
{
    const TABLE = 'partners';

    const SALE_SYSTEM_ID = 'network_id';
    const USER_ID = 'user_id';
    const COACH_ID = 'coach_id';
    const FRONT_IDENTITY_CARD_ID = 'front_identity_card_id';
    const BACK_IDENTITY_CARD_ID = 'back_identity_card_id';
    const BUSINESS_CERTIFICATION_ID = 'business_certification_id';
    const PARENT_ID = 'parent_id';
    const LEFT_TREE = 'left_tree';
    const RIGHT_TREE = 'right_tree';
    const MOBILE = 'mobile';
    const BANK_NAME = 'bank_name';
    const IBAN = 'iban';
    const SWIFT = 'swift';
    const RECEIVE_VAT_RESPONSIBLE = 'receive_vat_responsible';
    const SEND_VAT_RESPONSIBLE = 'send_vat_responsible';
    const ACTIVE_AUTO_BONUS = 'active_auto_bonus';
    const ACTIVE_TRAINING_BONUS = 'active_training_bonus';
    const POST_DELIVERY_FACTOR = 'post_delivery_factor';
    const RECEIVE_COMMISSION = 'receive_commission';
    const CAN_BUY = 'can_buy';
    const TRANSPORTATION_RATIO_PERCENTAGE = 'transportation_ratio_percentage';
    const OVER_PERSONAL_TURNOVER = 'over_personal_turnover';
    const CAN_SEE_DOWN_LINE = 'can_see_down_line';
    const INHOUSE_SALE = 'inhouse_sale';
    const HAS_NETWORK = 'has_network';
    const HAS_BTOB = 'has_btob';
    const HAS_BTOC = 'has_btoc';
    const HAS_WAREHOUSE = 'has_warehouse';
    const HAS_DELIVERY = 'has_delivery';
    const WARRANTY_DAYS = 'warranty_days';
    const MAX_CLIENT_ROOT = 'max_client_root';
    const IS_ACTIVE = 'is_active';

    /**
     * Create new Object.
     *
     * @param array $attributes Attribute to create an Entity.
     * @return PartnerInterface
     */
    public static function createObject(array $attributes): PartnerInterface;


    /**
     * Update an Object.
     *
     * @param array $attributes Attribute to update an Entity.
     * @return PartnerInterface
     */
    public function updateObject(array $attributes): PartnerInterface;
}
