<?php

namespace App\Traits\Filters;

use Illuminate\Database\Eloquent\Builder;

trait FilterMaxTaxFreeTradeTrait
{

    /**
     * Filter By Max Tax Free Trade.
     *
     * @param float $maxTaxFreeTrade Max Tax Free Trade.
     *
     * @return Builder
     */
    public function maxTaxFreeTrade(float $maxTaxFreeTrade): Builder
    {
        return $this->builder->whereMaxTaxFreeTrade($maxTaxFreeTrade);
    }

    /**
     * Filter By Max Tax Free Trade.
     *
     * @param float $maxTaxFreeTrade Max Tax Free Trade.
     *
     * @return Builder
     */
    public function maxTaxFreeTradeGreaterThan(float $maxTaxFreeTrade): Builder
    {
        return $this->builder->whereMaxTaxFreeTradeGreaterThan($maxTaxFreeTrade);
    }

    /**
     * Filter By Max Tax Free Trade.
     *
     * @param float $maxTaxFreeTrade Max Tax Free Trade.
     *
     * @return Builder
     */
    public function maxTaxFreeTradeLessThan(float $maxTaxFreeTrade): Builder
    {
        return $this->builder->whereMaxTaxFreeTradeLessThan($maxTaxFreeTrade);
    }
}
