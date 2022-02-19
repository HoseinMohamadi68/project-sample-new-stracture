<?php

namespace App\Traits\Filters;

use Illuminate\Database\Eloquent\Builder;

trait FilterIdsTrait
{
    /**
     * Filter by IDs.
     *
     * @param array $ids IDs.
     *
     * @return Builder
     */
    protected function ids(array $ids): Builder
    {
        return $this->builder->whereIdIn($ids);
    }
}
