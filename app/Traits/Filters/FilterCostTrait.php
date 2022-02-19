<?php

namespace App\Traits\Filters;

use Illuminate\Database\Eloquent\Builder;

trait FilterCostTrait
{
    /**
     * Filter by Cost.
     *
     * @param integer $cost Cost.
     *
     * @return Builder
     */
    protected function cost(int $cost): Builder
    {
        return $this->builder->whereCostIs($cost);
    }

    /**
     * Filter by Cost.
     *
     * @param integer $cost Cost.
     *
     * @return Builder
     */
    protected function costGreaterThan(int $cost): Builder
    {
        return $this->builder->whereCostGreaterThan($cost);
    }

    /**
     * Filter by Cost.
     *
     * @param integer $cost Cost.
     *
     * @return Builder
     */
    protected function costLessThan(int $cost): Builder
    {
        return $this->builder->whereCostLessThan($cost);
    }
}
