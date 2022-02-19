<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasMaxTaxFreeTradeTrait
{

    /**
     * @param Builder $builder         Builder.
     * @param float   $maxTaxFreeTrade Max Tax Free Trade.
     *
     * @return Builder
     */
    public function scopeWhereMaxTaxFreeTradeGreaterThan(Builder $builder, float $maxTaxFreeTrade): Builder
    {
        return $builder->where(self::MAX_TAX_FREE_TRADE, '>=', $maxTaxFreeTrade);
    }

    /**
     * @param Builder $builder         Builder.
     * @param float   $maxTaxFreeTrade Max Tax Free Trade.
     *
     * @return Builder
     */
    public function scopeWhereMaxTaxFreeTradeLessThan(Builder $builder, float $maxTaxFreeTrade): Builder
    {
        return $builder->where(self::MAX_TAX_FREE_TRADE, '<=', $maxTaxFreeTrade);
    }
}
