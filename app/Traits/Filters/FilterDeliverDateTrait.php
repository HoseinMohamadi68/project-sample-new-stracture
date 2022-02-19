<?php

namespace App\Traits\Filters;

use Illuminate\Database\Eloquent\Builder;

trait FilterDeliverDateTrait
{
    /**
     * Filter by DeliverDate.
     *
     * @param string $deliverDate DeliverDate.
     *
     * @return Builder
     */
    protected function deliverDate(string $deliverDate): Builder
    {
        return $this->builder->whereDeliverDateIs($deliverDate);
    }

    /**
     * Filter by Greater Than DeliverDate.
     *
     * @param string $deliverDate DeliverDate.
     *
     * @return Builder
     */
    public function deliverDateGreaterThan(string $deliverDate): Builder
    {
        return $this->builder->whereDeliverDateGreaterThan($deliverDate);
    }

    /**
     * Filter by Less Than DeliverDate.
     *
     * @param string $deliverDate DeliverDate.
     *
     * @return Builder
     */
    public function deliverDateLessThan(string $deliverDate): Builder
    {
        return $this->builder->whereDeliverDateLessThan($deliverDate);
    }
}
