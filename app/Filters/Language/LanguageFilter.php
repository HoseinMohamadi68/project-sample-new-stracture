<?php

namespace App\Filters\Language;

use App\Filters\Filters;
use App\Traits\Filters\FilterIdsTrait;
use App\Traits\Filters\FilterTitleTrait;
use Illuminate\Database\Eloquent\Builder;

class LanguageFilter extends Filters
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
        'isLtr',
    ];

    /**
     * Registered filters to operate upon.
     *
     * @var array
     */
    protected array $attributes = [
        'title' => 'string',
        'ids' => 'array',
        'isLtr' => 'boolean',
    ];

    /**
     * @param boolean $isLtr Is LTR.
     *
     * @return Builder
     */
    protected function isLtr(bool $isLtr): Builder
    {
        return $this->builder->whereIsLtr($isLtr);
    }
}
