<?php

namespace App\Traits\Filters;

use Illuminate\Database\Eloquent\Builder;

trait FilterMinimumCostTrait
{
    /**
     * Filter by Minimum Cost.
     *
     * @param integer $minimumCost Minimum Cost.
     *
     * @return Builder
     */
    protected function minimumCost(int $minimumCost): Builder
    {
        return $this->builder->whereMinimumCostIs($minimumCost);
    }

    /**
     * Filter by Minimum Cost.
     *
     * @param integer $minimumCost Minimum Cost.
     *
     * @return Builder
     */
    protected function minimumCostGreaterThan(int $minimumCost): Builder
    {
        return $this->builder->whereMinimumCostGreaterThan($minimumCost);
    }

    /**
     * Filter by Minimum Cost.
     *
     * @param integer $minimumCost Minimum Cost.
     *
     * @return Builder
     */
    protected function minimumCostLessThan(int $minimumCost): Builder
    {
        return $this->builder->whereMinimumCostLessThan($minimumCost);
    }
}
