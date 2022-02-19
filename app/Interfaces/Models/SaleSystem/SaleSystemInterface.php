<?php

namespace App\Interfaces\Models\SaleSystem;

use App\Interfaces\Models\BaseModelInterface;
use App\Interfaces\Traits\BelongsToManyPaymentMethodTypeInterface;
use App\Interfaces\Traits\HasBtobInterface;
use App\Interfaces\Traits\HasBtocInterface;
use App\Interfaces\Traits\HasDeliveryInterface;
use App\Interfaces\Traits\HasDescriptionInterface;
use App\Interfaces\Traits\HasDomainInterface;
use App\Interfaces\Traits\HasFaxInterface;
use App\Interfaces\Traits\HasIsActiveInterface;
use App\Interfaces\Traits\HasMaxClientRootInterface;
use App\Interfaces\Traits\HasNetworkInterface;
use App\Interfaces\Traits\HasPhoneInterface;
use App\Interfaces\Traits\HasRegisterNumberInterface;
use App\Interfaces\Traits\HasRegisterOfficeInterface;
use App\Interfaces\Traits\HasUserIdInterface;
use App\Interfaces\Traits\HasWareHouseInterface;
use App\Interfaces\Traits\HasWarrantyDaysInterface;

interface SaleSystemInterface extends
    BaseModelInterface,
    HasUserIdInterface,
    HasDomainInterface,
    HasRegisterNumberInterface,
    HasRegisterOfficeInterface,
    HasPhoneInterface,
    HasFaxInterface,
    HasNetworkInterface,
    HasBtobInterface,
    HasBtocInterface,
    HasDeliveryInterface,
    HasWareHouseInterface,
    HasWarrantyDaysInterface,
    HasMaxClientRootInterface,
    HasIsActiveInterface,
    BelongsToManyPaymentMethodTypeInterface
{
    const TABLE = 'sale_systems';

    const USER_ID = 'user_id';
    const DOMAIN = 'domain';
    const REGISTER_NUMBER = 'register_number';
    const REGISTER_OFFICE = 'register_office';
    const PHONE = 'phone';
    const FAX = 'fax';
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
     * @param array $attributes Attributes columns.
     *
     * @return SaleSystemInterface
     */
    public static function createObject(array $attributes): SaleSystemInterface;

    /**
     * Update an Object.
     *
     * @param array $attributes Attributes columns.
     *
     * @return SaleSystemInterface
     */
    public function updateObject(array $attributes): SaleSystemInterface;
}
