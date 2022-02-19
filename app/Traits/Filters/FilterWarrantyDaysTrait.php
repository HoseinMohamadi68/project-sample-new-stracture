<?php

namespace App\Traits\Filters;

use Illuminate\Database\Eloquent\Builder;

trait FilterWarrantyDaysTrait
{
    /**
     * Filter by Warranty Days.
     *
     * @param integer $warrantyDays Max Client Root.
     *
     * @return Builder
     */
    protected function warrantyDays(int $warrantyDays): Builder
    {
        return $this->builder->whereWarrantyDays($warrantyDays);
    }

    /**
     * Filter by Warranty Days.
     *
     * @param integer $warrantyDays Max Client Root.
     *
     * @return Builder
     */
    protected function warrantyDaysGreaterThan(int $warrantyDays): Builder
    {
        return $this->builder->whereWarrantyDaysGreaterThan($warrantyDays);
    }

    /**
     * Filter by Warranty Days.
     *
     * @param integer $warrantyDays Warranty Days.
     *
     * @return Builder
     */
    protected function warrantyDaysLessThan(int $warrantyDays): Builder
    {
        return $this->builder->whereWarrantyDaysLessThan($warrantyDays);
    }
}
