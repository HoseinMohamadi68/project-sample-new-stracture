<?php

namespace App\Interfaces\Traits;

use Illuminate\Database\Eloquent\Builder;

interface HasRatioInterface
{
    /**
     * @param Builder $builder Builder.
     * @param integer $ratio   Ratio.
     *
     * @return Builder
     */
    public function scopeWhereRatioGreaterThan(Builder $builder, int $ratio): Builder;

    /**
     * @param Builder $builder Builder.
     * @param integer $ratio   Ratio.
     *
     * @return Builder
     */
    public function scopeWhereRatioLesThan(Builder $builder, int $ratio): Builder;
}
