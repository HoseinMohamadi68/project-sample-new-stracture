<?php

namespace App\Interfaces\Traits;

use Illuminate\Database\Eloquent\Builder;

interface HasTotalCostInterface
{
    /**
     * @param Builder $builder   Builder.
     * @param integer $totalCost Total Cost.
     *
     * @return Builder
     */
    public function scopeWhereTotalCostGreaterThan(Builder $builder, int $totalCost): Builder;

    /**
     * @param Builder $builder   Builder.
     * @param integer $totalCost Total Cost.
     *
     * @return Builder
     */
    public function scopeWhereTotalCostLessThan(Builder $builder, int $totalCost): Builder;

    /**
     * @param Builder $builder   Builder.
     * @param integer $totalCost Total Cost.
     *
     * @return Builder
     */
    public function scopeWhereTotalCostIs(Builder $builder, int $totalCost): Builder;
}
