<?php

namespace App\Traits\Filters;

use Illuminate\Database\Eloquent\Builder;

trait FilterPaymentWayTrait
{
    /**
     * @param string $paymentWay Payment Way.
     *
     * @return Builder
     */
    protected function paymentWay(string $paymentWay): Builder
    {
        return $this->builder->wherePaymentWayIs($paymentWay);
    }
}
