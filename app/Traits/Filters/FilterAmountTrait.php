<?php

namespace App\Traits\Filters;

use Illuminate\Database\Eloquent\Builder;

trait FilterAmountTrait
{
    /**
     * Filter by Amount.
     *
     * @param integer $amount Amount percentage.
     *
     * @return Builder
     */
    protected function amount(int $amount): Builder
    {
        return $this->builder->whereAmountIs($amount);
    }

    /**
     * Filter by Amount.
     *
     * @param integer $amount Amount percentage.
     *
     * @return Builder
     */
    protected function amountGreaterThan(int $amount): Builder
    {
        return $this->builder->whereAmountGreaterThan($amount);
    }

    /**
     * Filter by Amount.
     *
     * @param integer $amount Amount percentage.
     *
     * @return Builder
     */
    protected function amountLessThan(int $amount): Builder
    {
        return $this->builder->whereAmountLessThan($amount);
    }
}
