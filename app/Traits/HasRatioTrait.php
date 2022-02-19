<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasRatioTrait
{
    /**
     * @param Builder $builder Builder.
     * @param integer $ratio   Ratio.
     *
     * @return Builder
     */
    public function scopeWhereRatioIs(Builder $builder, int $ratio): Builder
    {
        return $builder->where(self::RATIO, $ratio);
    }

    /**
     * @param Builder $builder Builder.
     * @param integer $ratio   Ratio.
     *
     * @return Builder
     */
    public function scopeWhereRatioGreaterThan(Builder $builder, int $ratio): Builder
    {
        return $builder->where(self::RATIO, '>=', $ratio);
    }

    /**
     * @param Builder $builder Builder.
     * @param integer $ratio   Ratio.
     *
     * @return Builder
     */
    public function scopeWhereRatioLesThan(Builder $builder, int $ratio): Builder
    {
        return $builder->where(self::Ratio, '<=', $ratio);
    }
}
