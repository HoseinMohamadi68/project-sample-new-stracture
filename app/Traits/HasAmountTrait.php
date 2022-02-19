<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasAmountTrait
{
    /**
     * @param Builder $builder Builder.
     * @param integer $amount  Amount.
     *
     * @return Builder
     */
    public function scopeWhereAmountIs(Builder $builder, int $amount): Builder
    {
        return $builder->where(self::AMOUNT, $amount);
    }

    /**
     * @param Builder $builder Builder.
     * @param integer $amount  Amount.
     *
     * @return Builder
     */
    public function scopeWhereAmountGreaterThan(Builder $builder, int $amount): Builder
    {
        return $builder->where(self::AMOUNT, '>=', $amount);
    }

    /**
     * @param Builder $builder Builder.
     * @param integer $amount  Amount.
     *
     * @return Builder
     */
    public function scopeWhereAmountLesThan(Builder $builder, int $amount): Builder
    {
        return $builder->where(self::AMOUNT, '<=', $amount);
    }
}
