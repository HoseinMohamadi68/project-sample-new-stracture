<?php

namespace App\Traits\Filters;

use Illuminate\Database\Eloquent\Builder;

trait FilterOrderIdTrait
{
    /**
     * Filter by Order Id.
     *
     * @param integer $orderId Order Id.
     *
     * @return Builder
     */
    protected function orderId(int $orderId): Builder
    {
        return $this->builder->whereOrderIdIs($orderId);
    }

    /**
     * Filter by Order Ids.
     *
     * @param array $orderIds Order Ids.
     *
     * @return Builder
     */
    protected function orderIds(array $orderIds): Builder
    {
        return $this->builder->whereOrderIdIn($orderIds);
    }
}
