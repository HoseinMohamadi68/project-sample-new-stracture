<?php

namespace App\Traits;

use App\Models\Currency\Currency;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasCurrencyIdTrait
{
    /**
     * @param Builder $builder    Builder.
     * @param array   $currencyId IDs.
     *
     * @return Builder
     */
    public function scopeWhereCurrencyIdIn(Builder $builder, array $currencyId): Builder
    {
        return $builder->whereIn(self::CURRENCY_ID, $currencyId);
    }

    /**
     * @return BelongsTo
     */
    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }
}
