<?php

namespace App\Filters\SaleSystem;

use App\Filters\Filters;
use App\Traits\Filters\FilterDescriptionTrait;
use App\Traits\Filters\FilterDomainTrait;
use App\Traits\Filters\FilterFaxTrait;
use App\Traits\Filters\FilterHasBtobTrait;
use App\Traits\Filters\FilterHasBtocTrait;
use App\Traits\Filters\FilterHasDeliveryTrait;
use App\Traits\Filters\FilterHasNetworkTrait;
use App\Traits\Filters\FilterHasWarehouseTrait;
use App\Traits\Filters\FilterIdsTrait;
use App\Traits\Filters\FilterIsActiveTrait;
use App\Traits\Filters\FilterMaxClientRootTrait;
use App\Traits\Filters\FilterPhoneTrait;
use App\Traits\Filters\FilterRegisterNumberTrait;
use App\Traits\Filters\FilterRegisterOfficeTrait;
use App\Traits\Filters\FilterUserIdTrait;
use App\Traits\Filters\FilterWarrantyDaysTrait;

class SaleSystemFilter extends Filters
{
    use FilterIdsTrait;
    use FilterUserIdTrait;
    use FilterDomainTrait;
    use FilterRegisterNumberTrait;
    use FilterRegisterOfficeTrait;
    use FilterPhoneTrait;
    use FilterFaxTrait;
    use FilterDescriptionTrait;
    use FilterHasNetworkTrait;
    use FilterHasBtobTrait;
    use FilterHasBtocTrait;
    use FilterHasWarehouseTrait;
    use FilterHasDeliveryTrait;
    use FilterWarrantyDaysTrait;
    use FilterMaxClientRootTrait;
    use FilterIsActiveTrait;

    /**
     * Registered filters to operate upon.
     *
     * @var array
     */
    protected array $filters = [
        'ids',
        'userId',
        'domain',
        'registerNumber',
        'registerOffice',
        'phone',
        'fax',
        'description',
        'hasNetwork',
        'hasBtob',
        'hasBtoc',
        'hasWarehouse',
        'hasDelivery',
        'warrantyDays',
        'maxClientRoot',
        'active',
    ];

    /**
     * Registered filters to operate upon.
     *
     * @var array
     */
    protected array $attributes = [
        'ids' => 'array',
        'userId' => 'int',
        'domain' => 'string',
        'registerNumber' => 'string',
        'registerOffice' => 'string',
        'phone' => 'string',
        'fax' => 'string',
        'description' => 'string',
        'hasNetwork' => 'bool',
        'hasBtob' => 'bool',
        'hasBtoc' => 'bool',
        'hasWarehouse' => 'bool',
        'hasDelivery' => 'bool',
        'warrantyDays' => 'int',
        'maxClientRoot' => 'int',
        'active' => 'bool',
    ];
}
