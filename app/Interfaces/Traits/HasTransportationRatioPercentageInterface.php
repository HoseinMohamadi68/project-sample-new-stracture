<?php

namespace App\Interfaces\Traits;

use Illuminate\Database\Eloquent\Builder;

interface HasTransportationRatioPercentageInterface
{
    /**
     * @param Builder $builder                       Builder.
     * @param integer $transportationRatioPercentage Transportation Ratio Percentage.
     *
     * @return Builder
     */
    public function scopeWhereTransportationRatioPercentageGreaterThan(Builder $builder, int $transportationRatioPercentage): Builder;

    /**
     * @param Builder $builder                       Builder.
     * @param integer $transportationRatioPercentage Transportation Ratio Percentage.
     *
     * @return Builder
     */
    public function scopeWhereTransportationRatioPercentageLessThan(Builder $builder, int $transportationRatioPercentage): Builder;
}
