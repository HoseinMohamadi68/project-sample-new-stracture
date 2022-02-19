<?php

namespace App\Interfaces\Traits;

use Illuminate\Database\Eloquent\Builder;

interface HasDefaultWarrantyDaysInterface
{
    const DEFAULT_WARRANTY_DAYS = 'default_warranty_days';

    /**
     * @param Builder $builder             Builder.
     * @param integer $defaultWarrantyDays Warranty Days.
     *
     * @return Builder
     */
    public function scopeWhereDefaultWarrantyDaysGreaterThan(Builder $builder, int $defaultWarrantyDays): Builder;

    /**
     * @param Builder $builder      Builder.
     * @param integer $warrantyDays Warranty Days.
     *
     * @return Builder
     */
    public function scopeWhereDefaultWarrantyDaysLessThan(Builder $builder, int $warrantyDays): Builder;
}
