<?php

namespace App\Traits\Filters;

use Illuminate\Database\Eloquent\Builder;

trait FilterTotalCostTrait
{
    /**
     * Filter by TotalCost.
     *
     * @param integer $totalCost TotalCost.
     *
     * @return Builder
     */
    protected function totalCost(int $totalCost): Builder
    {
        return $this->builder->whereTotalCost($totalCost);
    }

    /**
     * Filter by TotalCost.
     *
     * @param integer $totalCost TotalCost.
     *
     * @return Builder
     */
    protected function totalCostGreaterThan(int $totalCost): Builder
    {
        return $this->builder->whereTotalCostGreaterThan($totalCost);
    }

    /**
     * Filter by TotalCost.
     *
     * @param integer $totalCost TotalCost.
     *
     * @return Builder
     */
    protected function totalCostLessThan(int $totalCost): Builder
    {
        return $this->builder->whereTotalCostLessThan($totalCost);
    }
}
