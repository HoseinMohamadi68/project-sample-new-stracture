<?php

namespace App\Filters;

use App\Traits\Filters\FilterIdsTrait;
use App\Traits\Filters\FilterTitleTrait;

class PermissionFilter extends Filters
{
    use FilterIdsTrait;
    use FilterTitleTrait;

    /**
     * Registered filters to operate upon.
     *
     * @var array
     */
    protected array $filters = [
        'title',
        'ids',
    ];

    /**
     * Registered filters to operate upon.
     *
     * @var array
     */
    protected array $attributes = [
        'title' => 'string',
        'ids' => 'array',
    ];
}
