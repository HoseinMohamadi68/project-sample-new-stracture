<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasTotalCostTrait
{
    /**
     * @param Builder $builder   Builder.
     * @param integer $totalCost TotalCost.
     *
     * @return Builder
     */
    public function scopeWhereTotalCostGreaterThan(Builder $builder, int $totalCost): Builder
    {
        return $builder->where(self::TOTAL_COST, '>=', $totalCost);
    }

    /**
     * @param Builder $builder   Builder.
     * @param integer $totalCost TotalCost.
     *
     * @return Builder
     */
    public function scopeWhereTotalCostLessThan(Builder $builder, int $totalCost): Builder
    {
        return $builder->where(self::TOTAL_COST, '<=', $totalCost);
    }

    /**
     * @param Builder $builder   Builder.
     * @param integer $totalCost TotalCost.
     *
     * @return Builder
     */
    public function scopeWhereTotalCostIs(Builder $builder, int $totalCost): Builder
    {
        return $builder->where(self::TOTAL_COST, $totalCost);
    }
}
