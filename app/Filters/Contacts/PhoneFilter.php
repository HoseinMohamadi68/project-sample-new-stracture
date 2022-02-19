<?php

namespace App\Filters\Contacts;

use App\Filters\Filters;
use App\Traits\Filters\FilterIdsTrait;
use App\Traits\Filters\FilterNumberTrait;
use App\Traits\Filters\FilterTypeTrait;

class PhoneFilter extends Filters
{
    use FilterIdsTrait;
    use FilterTypeTrait;
    use FilterNumberTrait;

    /**
     * @var array|string[]
     */
    protected array $filters = [
        'ids',
        'type',
        'number',
    ];

    /**
     * @var array|string[]
     */
    protected array $attributes = [
        'ids' => 'array',
        'type' => 'string',
        'number' => 'string',
    ];
}
