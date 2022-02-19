<?php

namespace App\Filters\Country;

use App\Filters\Filters;
use App\Traits\Filters\FilterCurrencyIdTrait;
use App\Traits\Filters\FilterDefaultVatTrait;
use App\Traits\Filters\FilterDefaultWarrantyDaysTrait;
use App\Traits\Filters\FilterIdsTrait;
use App\Traits\Filters\FilterIsEeuTrait;
use App\Traits\Filters\FilterIso2Trait;
use App\Traits\Filters\FilterIso3Trait;
use App\Traits\Filters\FilterMaxSmallBusinessTradeTrait;
use App\Traits\Filters\FilterMaxTaxFreeTradeTrait;
use App\Traits\Filters\FilterNameTranslateTrait;

class CountryFilter extends Filters
{
    use FilterIdsTrait;
    use FilterNameTranslateTrait;
    use FilterCurrencyIdTrait;
    use FilterDefaultVatTrait;
    use FilterDefaultWarrantyDaysTrait;
    use FilterMaxTaxFreeTradeTrait;
    use FilterMaxSmallBusinessTradeTrait;
    use FilterIsEeuTrait;
    use FilterIso2Trait;
    use FilterIso3Trait;

    /**
     * Registered filters to operate upon.
     *
     * @var array
     */
    protected array $filters = [
        'ids',
        'name',
        'currencyId',
        'defaultVat',
        'defaultWarrantyDays',
        'maxTaxFreeTrade',
        'maxSmallBusinessTrade',
        'isEeu',
        'iso2',
        'iso3',
    ];

    /**
     * Registered filters to operate upon.
     *
     * @var array
     */
    protected array $attributes = [
        'ids' => 'array',
        'name' => 'string',
        'currencyId' => 'int',
        'defaultVat' => 'float',
        'defaultWarrantyDays' => 'int',
        'maxTaxFreeTrade' => 'float',
        'maxSmallBusinessTrade' => 'float',
        'isEeu' => 'bool',
        'iso2' => 'string',
        'iso3' => 'string',
    ];
}
