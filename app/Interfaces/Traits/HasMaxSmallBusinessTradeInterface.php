<?php

namespace App\Interfaces\Traits;

use Illuminate\Database\Eloquent\Builder;

interface HasMaxSmallBusinessTradeInterface
{
    const MAX_SMALL_BUSINESS_TRADE = 'max_small_business_trade';

    /**
     * @param Builder $builder               Builder.
     * @param float   $maxSmallBusinessTrade Max Small Business Trade.
     *
     * @return Builder
     */
    public function scopeWhereMaxSmallBusinessTradeGreaterThan(Builder $builder, float $maxSmallBusinessTrade): Builder;

    /**
     * @param Builder $builder               Builder.
     * @param float   $maxSmallBusinessTrade Max Small Business Trade.
     *
     * @return Builder
     */
    public function scopeWhereMaxSmallBusinessTradeLessThan(Builder $builder, float $maxSmallBusinessTrade): Builder;
}
