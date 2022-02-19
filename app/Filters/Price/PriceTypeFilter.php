<?php

namespace App\Filters\Price;

use App\Filters\Filters;
use App\Traits\Filters\FilterIdsTrait;
use App\Traits\Filters\FilterNameTrait;

class PriceTypeFilter extends Filters
{
    use FilterNameTrait;
    use FilterIdsTrait;

    /**
     * Registered filters to operate upon.
     *
     * @var array
     */
    protected array $filters = ['ids','name'];

    /**
     * Registered filters to operate upon.
     *
     * @var array
     */
    protected array $attributes = ['ids' => 'array','name' => 'string'];
}
