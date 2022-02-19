<?php

namespace App\Interfaces\Traits;

use Illuminate\Database\Eloquent\Builder;

interface HasWeightSystemCostInterface
{
    /**
     * @param Builder $builder          Builder.
     * @param integer $weightSystemCost Weight System Cost.
     *
     * @return Builder
     */
    public function scopeWhereWeightSystemCostGreaterThan(Builder $builder, int $weightSystemCost): Builder;

    /**
     * @param Builder $builder          Builder.
     * @param integer $weightSystemCost Weight System Cost.
     *
     * @return Builder
     */
    public function scopeWhereWeightSystemCostLessThan(Builder $builder, int $weightSystemCost): Builder;

    /**
     * @param Builder $builder          Builder.
     * @param integer $weightSystemCost Weight System Cost.
     *
     * @return Builder
     */
    public function scopeWhereWeightSystemCostIs(Builder $builder, int $weightSystemCost): Builder;
}
