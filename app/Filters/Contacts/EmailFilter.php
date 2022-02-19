<?php

namespace App\Filters\Contacts;

use App\Filters\Filters;
use App\Traits\Filters\FilterEmailTrait;
use App\Traits\Filters\FilterIdsTrait;

class EmailFilter extends Filters
{
    use FilterIdsTrait;
    use FilterEmailTrait;

    /**
     * Registered filters to operate upon.
     *
     * @var array
     */
    protected array $filters = [
        'ids',
        'email'
    ];

    /**
     * Registered filters to operate upon.
     *
     * @var array
     */
    protected array $attributes = [
        'ids' => 'array',
        'email' => 'string',
    ];
}
