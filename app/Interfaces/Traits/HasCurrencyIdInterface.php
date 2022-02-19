<?php

namespace App\Interfaces\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

interface HasCurrencyIdInterface
{
    const CURRENCY_ID = 'currency_id';

    /**
     * @param Builder $builder    Builder.
     * @param array   $currencyId IDs.
     *
     * @return Builder
     */
    public function scopeWhereCurrencyIdIn(Builder $builder, array $currencyId): Builder;

    /**
     * @return BelongsTo
     */
    public function currency(): BelongsTo;
}
