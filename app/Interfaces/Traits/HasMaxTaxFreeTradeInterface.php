<?php

namespace App\Interfaces\Traits;

use Illuminate\Database\Eloquent\Builder;

interface HasMaxTaxFreeTradeInterface
{
    const MAX_TAX_FREE_TRADE = 'max_tax_free_trade';

    /**
     * @param Builder $builder         Builder.
     * @param float   $maxTaxFreeTrade Max Tax Free Trade.
     *
     * @return Builder
     */
    public function scopeWhereMaxTaxFreeTradeGreaterThan(Builder $builder, float $maxTaxFreeTrade): Builder;

    /**
     * @param Builder $builder         Builder.
     * @param float   $maxTaxFreeTrade Max Tax Free Trade.
     *
     * @return Builder
     */
    public function scopeWhereMaxTaxFreeTradeLessThan(Builder $builder, float $maxTaxFreeTrade): Builder;
}
