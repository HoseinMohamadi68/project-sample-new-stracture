<?php

namespace App\Traits\Filters;

use Illuminate\Database\Eloquent\Builder;

trait FilterDischargeCostTrait
{
    /**
     * Filter by Discharge Cost.
     *
     * @param integer $cost Discharge Cost.
     *
     * @return Builder
     */
    protected function cost(int $cost): Builder
    {
        return $this->builder->whereDischargeCostIs($cost);
    }

    /**
     * Filter by Discharge Cost.
     *
     * @param integer $cost Discharge Cost.
     *
     * @return Builder
     */
    protected function costGreaterThan(int $cost): Builder
    {
        return $this->builder->whereDischargeCostGreaterThan($cost);
    }

    /**
     * Filter by Discharge Cost.
     *
     * @param integer $cost Discharge Cost.
     *
     * @return Builder
     */
    protected function costLessThan(int $cost): Builder
    {
        return $this->builder->whereDischargeCostLessThan($cost);
    }
}
