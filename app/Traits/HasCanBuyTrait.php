<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasCanBuyTrait
{
    /**
     * @param Builder $builder Builder.
     *
     * @return Builder
     */
    public function scopeWhereCanBuy(Builder $builder): Builder
    {
        return $builder->where(self::CAN_BUY, true);
    }

    /**
     * @param Builder $builder Builder.
     *
     * @return Builder
     */
    public function scopeWhereCantBuy(Builder $builder): Builder
    {
        return $builder->where(self::CAN_BUY, false);
    }
}
