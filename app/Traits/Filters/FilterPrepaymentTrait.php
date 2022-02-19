<?php

namespace App\Traits\Filters;

use Illuminate\Database\Eloquent\Builder;

trait FilterPrepaymentTrait
{
    /**
     * Filter by Prepayment.
     *
     * @param integer $prepayment Prepayment.
     *
     * @return Builder
     */
    protected function prepayment(int $prepayment): Builder
    {
        return $this->builder->wherePrepaymentIs($prepayment);
    }

    /**
     * Filter by Prepayment.
     *
     * @param integer $prepayment Prepayment.
     *
     * @return Builder
     */
    protected function prepaymentGreaterThan(int $prepayment): Builder
    {
        return $this->builder->wherePrepaymentGreaterThan($prepayment);
    }

    /**
     * Filter by Prepayment.
     *
     * @param integer $prepayment Prepayment.
     *
     * @return Builder
     */
    protected function prepaymentLessThan(int $prepayment): Builder
    {
        return $this->builder->wherePrepaymentLessThan($prepayment);
    }
}
