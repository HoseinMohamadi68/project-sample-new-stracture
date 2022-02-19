<?php

namespace App\Traits\Filters;

use Illuminate\Database\Eloquent\Builder;

trait FilterTaxTrait
{
    /**
     * Filter by Tax.
     *
     * @param integer $tax Tax percentage.
     *
     * @return Builder
     */
    protected function tax(int $tax): Builder
    {
        return $this->builder->whereTaxIs($tax);
    }

    /**
     * Filter by Tax.
     *
     * @param integer $tax Tax percentage.
     *
     * @return Builder
     */
    protected function taxGreaterThan(int $tax): Builder
    {
        return $this->builder->whereTaxGreaterThan($tax);
    }

    /**
     * Filter by Tax.
     *
     * @param integer $tax Tax percentage.
     *
     * @return Builder
     */
    protected function taxLessThan(int $tax): Builder
    {
        return $this->builder->whereTaxLessThan($tax);
    }
}
