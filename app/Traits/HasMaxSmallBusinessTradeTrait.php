<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasMaxSmallBusinessTradeTrait
{
    /**
     * @param Builder $builder               Builder.
     * @param float   $maxSmallBusinessTrade Max Small Business Trade.
     *
     * @return Builder
     */
    public function scopeWhereMaxSmallBusinessTradeGreaterThan(Builder $builder, float $maxSmallBusinessTrade): Builder
    {
        return $builder->where(self::MAX_SMALL_BUSINESS_TRADE, '>=', $maxSmallBusinessTrade);
    }

    /**
     * @param Builder $builder               Builder.
     * @param float   $maxSmallBusinessTrade Max Tax Free Trade.
     *
     * @return Builder
     */
    public function scopeWhereMaxSmallBusinessTradeLessThan(Builder $builder, float $maxSmallBusinessTrade): Builder
    {
        return $builder->where(self::MAX_SMALL_BUSINESS_TRADE, '<=', $maxSmallBusinessTrade);
    }
}
