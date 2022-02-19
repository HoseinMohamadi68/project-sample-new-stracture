<?php

namespace App\Traits\Filters;

use Illuminate\Database\Eloquent\Builder;

trait FilterAddressIdTrait
{
    /**
     * Filter by User Id.
     *
     * @param integer $addressId User Id.
     *
     * @return Builder
     */
    protected function addressId(int $addressId): Builder
    {
        return $this->builder->whereUserIdIs($addressId);
    }

    /**
     * Filter by User Ids.
     *
     * @param array $addressIds User Ids.
     *
     * @return Builder
     */
    protected function addressIds(array $addressIds): Builder
    {
        return $this->builder->whereUserIdIn($addressIds);
    }
}
