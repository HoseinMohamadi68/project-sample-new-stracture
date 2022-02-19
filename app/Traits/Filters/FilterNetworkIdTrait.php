<?php

namespace App\Traits\Filters;

use Illuminate\Database\Eloquent\Builder;

trait FilterNetworkIdTrait
{
    /**
     * Filter by SaleSystem Id.
     *
     * @param integer $networkId SaleSystem Id.
     *
     * @return Builder
     */
    protected function networkId(int $networkId): Builder
    {
        return $this->builder->whereNetworkId($networkId);
    }

    /**
     * Filter by SaleSystem Ids.
     *
     * @param array $networkIds SaleSystem Ids.
     *
     * @return Builder
     */
    protected function networkIds(array $networkIds): Builder
    {
        return $this->builder->whereNetworkIdIn($networkIds);
    }
}
