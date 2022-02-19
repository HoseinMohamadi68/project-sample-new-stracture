<?php

namespace App\Traits\Filters;

use Illuminate\Database\Eloquent\Builder;

trait FilterParentIdTrait
{
    /**
     * Filter by Parent Id.
     *
     * @param integer $parentId Parent Id.
     *
     * @return Builder
     */
    protected function parentId(int $parentId): Builder
    {
        return $this->builder->whereParentIdIs($parentId);
    }

    /**
     * Filter by Parent Ids.
     *
     * @param array $parentIds Parent Ids.
     *
     * @return Builder
     */
    protected function parentIds(array $parentIds): Builder
    {
        return $this->builder->whereParentIdIn($parentIds);
    }
}
