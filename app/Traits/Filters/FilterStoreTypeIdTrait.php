<?php

namespace App\Traits\Filters;

use Illuminate\Database\Eloquent\Builder;

trait FilterStoreTypeIdTrait
{
    /**
     * Filter by Store Type Id.
     *
     * @param integer $storeTypeId Store Type Id.
     *
     * @return Builder
     */
    protected function storeTypeId(int $storeTypeId): Builder
    {
        return $this->builder->whereStoreTypeIdIs($storeTypeId);
    }

    /**
     * Filter by Store Type Ids.
     *
     * @param array $storeTypeIds Store Type Ids.
     *
     * @return Builder
     */
    protected function storeTypeIds(array $storeTypeIds): Builder
    {
        return $this->builder->whereStoreTypeIdIn($storeTypeIds);
    }
}
