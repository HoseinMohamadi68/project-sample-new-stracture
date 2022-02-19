<?php

namespace App\Filters\Payment;

use App\Filters\Filters;
use App\Traits\Filters\FilterIdsTrait;
use App\Traits\Filters\FilterTitleTrait;

class PaymentMethodTypeFilter extends Filters
{
    use FilterIdsTrait;
    use FilterTitleTrait;

    /**
     * Registered filters to operate upon.
     *
     * @var array
     */
    protected array $filters = [
        'ids',
        'title'
    ];

    /**
     * Registered filters to operate upon.
     *
     * @var array
     */
    protected array $attributes = [
        'ids' => 'array',
        'title' => 'string',
    ];
}
