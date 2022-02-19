<?php

namespace App\Traits\Filters;

use Illuminate\Database\Eloquent\Builder;

trait FilterStartNumberTrait
{
    /**
     * Filter by Start Number.
     *
     * @param integer $startNumber StartNumber.
     *
     * @return Builder
     */
    protected function startNumber(int $startNumber): Builder
    {
        return $this->builder->whereStartNumberIs($startNumber);
    }

    /**
     * Filter by Start Number.
     *
     * @param integer $startNumber Start Number.
     *
     * @return Builder
     */
    protected function startNumberGreaterThan(int $startNumber): Builder
    {
        return $this->builder->whereStartNumberGreaterThan($startNumber);
    }

    /**
     * Filter by Start Number.
     *
     * @param integer $startNumber Start Number.
     *
     * @return Builder
     */
    protected function startNumberLessThan(int $startNumber): Builder
    {
        return $this->builder->whereStartNumberLessThan($startNumber);
    }
}
