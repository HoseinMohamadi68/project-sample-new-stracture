<?php

namespace App\Filters;

use App\Traits\Filters\FilterEnableTrait;
use App\Traits\Filters\FilterExtensionTrait;
use App\Traits\Filters\FilterIdsTrait;
use App\Traits\Filters\FilterNameTrait;
use App\Traits\Filters\FilterRootFilesTrait;

class FileFilter extends Filters
{
    use FilterIdsTrait;
    use FilterEnableTrait;
    use FilterExtensionTrait;
    use FilterNameTrait;
    use FilterRootFilesTrait;

    /**
     * Registered filters to operate upon.
     *
     * @var array
     */
    protected array $filters = [
        'rootFiles',
        'name',
        'extension',
        'enable',
        'ids',
    ];

    /**
     * Registered filters to operate upon.
     *
     * @var array
     */
    protected array $attributes = [
        'rootFiles' => 'array',
        'name' => 'string',
        'extension' => 'string',
        'enable' => 'boolean',
        'ids' => 'array',
    ];
}
