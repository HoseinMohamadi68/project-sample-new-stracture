<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasWarrantyDaysTrait
{
    /**
     * @param Builder $builder      Builder.
     * @param integer $warrantyDays Warranty Days.
     *
     * @return Builder
     */
    public function scopeWhereWarrantyDaysGreaterThan(Builder $builder, int $warrantyDays): Builder
    {
        return $builder->where(self::WARRANTY_DAYS, '>=', $warrantyDays);
    }

    /**
     * @param Builder $builder      Builder.
     * @param integer $warrantyDays Warranty Days.
     *
     * @return Builder
     */
    public function scopeWhereWarrantyDaysLessThan(Builder $builder, int $warrantyDays): Builder
    {
        return $builder->where(self::WARRANTY_DAYS, '<=', $warrantyDays);
    }
}
