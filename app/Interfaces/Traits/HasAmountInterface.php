<?php

namespace App\Interfaces\Traits;

use Illuminate\Database\Eloquent\Builder;

interface HasAmountInterface
{
    /**
     * @param Builder $builder Builder.
     * @param integer $amount  Amount.
     *
     * @return Builder
     */
    public function scopeWhereAmountIs(Builder $builder, int $amount): Builder;

    /**
     * @param Builder $builder Builder.
     * @param integer $amount  Amount.
     *
     * @return Builder
     */
    public function scopeWhereAmountGreaterThan(Builder $builder, int $amount): Builder;

    /**
     * @param Builder $builder Builder.
     * @param integer $amount  Amount.
     *
     * @return Builder
     */
    public function scopeWhereAmountLesThan(Builder $builder, int $amount): Builder;
}
