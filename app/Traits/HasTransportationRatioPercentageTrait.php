<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasTransportationRatioPercentageTrait
{
    /**
     * @param Builder $builder                       Builder.
     * @param integer $transportationRatioPercentage Transportation Ratio Percentage.
     *
     * @return Builder
     */
    public function scopeWhereTransportationRatioPercentageGreaterThan(Builder $builder, int $transportationRatioPercentage): Builder
    {
        return $builder->where(self::TRANSPORTATION_RATIO_PERCENTAGE, '>=', $transportationRatioPercentage);
    }

    /**
     * @param Builder $builder                       Builder.
     * @param integer $transportationRatioPercentage Transportation Ratio Percentage.
     *
     * @return Builder
     */
    public function scopeWhereTransportationRatioPercentageLessThan(Builder $builder, int $transportationRatioPercentage): Builder
    {
        return $builder->where(self::TRANSPORTATION_RATIO_PERCENTAGE, '<=', $transportationRatioPercentage);
    }
}
