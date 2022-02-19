<?php

namespace App\Traits\Filters;

use Illuminate\Database\Eloquent\Builder;

trait FilterRatioTrait
{
    /**
     * Filter by Rate.
     *
     * @param float $ratio Ratio.
     *
     * @return Builder
     */
    protected function ratio(float $ratio): Builder
    {
        return $this->builder->whereRatio($ratio);
    }

    /**
     * @param float $ratio Ratio.
     *
     * @return Builder
     */
    protected function ratioGreaterThan(float $ratio): Builder
    {
        return $this->builder->whereRatioGreaterThan($ratio);
    }

    /**
     * @param float $ratio Ratio.
     *
     * @return Builder
     */
    protected function ratioLessThan(float $ratio): Builder
    {
        return $this->builder->whereRatioLessThan($ratio);
    }
}
