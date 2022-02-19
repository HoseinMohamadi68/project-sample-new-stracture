<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasDefaultWarrantyDaysTrait
{
    /**
     * @param Builder $builder             Builder.
     * @param integer $defaultWarrantyDays Warranty Days.
     *
     * @return Builder
     */
    public function scopeWhereDefaultWarrantyDaysIs(Builder $builder, int $defaultWarrantyDays): Builder
    {
        return $builder->where(self::DEFAULT_WARRANTY_DAYS, '=', $defaultWarrantyDays);
    }

    /**
     * @param Builder $builder             Builder.
     * @param integer $defaultWarrantyDays Warranty Days.
     *
     * @return Builder
     */
    public function scopeWhereDefaultWarrantyDaysGreaterThan(Builder $builder, int $defaultWarrantyDays): Builder
    {
        return $builder->where(self::DEFAULT_WARRANTY_DAYS, '>=', $defaultWarrantyDays);
    }

    /**
     * @param Builder $builder      Builder.
     * @param integer $warrantyDays Warranty Days.
     *
     * @return Builder
     */
    public function scopeWhereDefaultWarrantyDaysLessThan(Builder $builder, int $warrantyDays): Builder
    {
        return $builder->where(self::DEFAULT_WARRANTY_DAYS, '<=', $warrantyDays);
    }
}
