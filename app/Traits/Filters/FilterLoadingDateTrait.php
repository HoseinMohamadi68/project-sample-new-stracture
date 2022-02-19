<?php

namespace App\Traits\Filters;

use Illuminate\Database\Eloquent\Builder;

trait FilterLoadingDateTrait
{
    /**
     * Filter by LoadingDate.
     *
     * @param string $loadingDate LoadingDate.
     *
     * @return Builder
     */
    protected function loadingDate(string $loadingDate): Builder
    {
        return $this->builder->whereLoadingDateIs($loadingDate);
    }

    /**
     * Filter by Greater Than LoadingDate.
     *
     * @param string $loadingDate LoadingDate.
     *
     * @return Builder
     */
    public function loadingDateGreaterThan(string $loadingDate): Builder
    {
        return $this->builder->whereLoadingDateGreaterThan($loadingDate);
    }

    /**
     * Filter by Less Than LoadingDate.
     *
     * @param string $loadingDate LoadingDate.
     *
     * @return Builder
     */
    public function loadingDateLessThan(string $loadingDate): Builder
    {
        return $this->builder->whereLoadingDateLessThan($loadingDate);
    }
}
