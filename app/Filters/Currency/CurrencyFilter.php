<?php

namespace App\Filters\Currency;

use App\Filters\Filters;
use App\Traits\Filters\FilterIdsTrait;
use App\Traits\Filters\FilterIsDefaultTrait;
use App\Traits\Filters\FilterIso3Trait;
use App\Traits\Filters\FilterRatioTrait;
use App\Traits\Filters\FilterSymbolTrait;
use App\Traits\Filters\FilterTitleTrait;

class CurrencyFilter extends Filters
{
    use FilterIdsTrait;
    use FilterTitleTrait;
    use FilterRatioTrait;
    use FilterIsDefaultTrait;
    use FilterIso3Trait;
    use FilterSymbolTrait;

    /**
     * Registered filters to operate upon.
     *
     * @var array
     */
    protected array $filters = [
        'ids',
        'title',
        'ratio',
        'isDefault',
        'symbol',
        'iso3'
    ];

    /**
     * Registered filters to operate upon.
     *
     * @var array
     */
    protected array $attributes = [
        'ids' => 'array',
        'title' => 'string',
        'ratio' => 'float',
        'isDefault' => 'bool',
        'symbol' => 'string',
        'iso3' => 'string'
    ];
}
