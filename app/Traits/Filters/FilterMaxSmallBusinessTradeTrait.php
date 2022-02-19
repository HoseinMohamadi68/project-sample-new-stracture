<?php

namespace App\Traits\Filters;

use Illuminate\Database\Eloquent\Builder;

trait FilterMaxSmallBusinessTradeTrait
{

    /**
     * Filter By Max Small Business Trade.
     *
     * @param float $maxSmallBusinessTrade Max Small Business Trade.
     *
     * @return Builder
     */
    public function maxSmallBusinessTrade(float $maxSmallBusinessTrade): Builder
    {
        return $this->builder->whereMaxSmallBusinessTrade($maxSmallBusinessTrade);
    }

    /**
     * Filter By Max Small Business Trade.
     *
     * @param float $maxSmallBusinessTrade Max Small Business Trade.
     *
     * @return Builder
     */
    public function maxSmallBusinessTradeGreaterThan(float $maxSmallBusinessTrade): Builder
    {
        return $this->builder->whereMaxSmallBusinessTradeGreaterThan($maxSmallBusinessTrade);
    }

    /**
     * Filter By Max Small Business Trade.
     *
     * @param float $maxSmallBusinessTrade Max Small Business Trade.
     *
     * @return Builder
     */
    public function maxSmallBusinessTradeLessThan(float $maxSmallBusinessTrade): Builder
    {
        return $this->builder->whereMaxSmallBusinessTradeLessThan($maxSmallBusinessTrade);
    }
}
