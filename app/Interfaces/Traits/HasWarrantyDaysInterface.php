<?php

namespace App\Interfaces\Traits;

use Illuminate\Database\Eloquent\Builder;

interface HasWarrantyDaysInterface
{
    /**
     * @param Builder $builder      Builder.
     * @param integer $warrantyDays Warranty Days.
     *
     * @return Builder
     */
    public function scopeWhereWarrantyDaysGreaterThan(Builder $builder, int $warrantyDays): Builder;

    /**
     * @param Builder $builder      Builder.
     * @param integer $warrantyDays Warranty Days.
     *
     * @return Builder
     */
    public function scopeWhereWarrantyDaysLessThan(Builder $builder, int $warrantyDays): Builder;
}
