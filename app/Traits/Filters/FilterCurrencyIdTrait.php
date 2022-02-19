<?php

namespace App\Traits\Filters;

use Illuminate\Database\Eloquent\Builder;

trait FilterCurrencyIdTrait
{
    /**
     * Filter by Currency Id.
     *
     * @param integer $currencyId Currency Id.
     *
     * @return Builder
     */
    protected function currencyId(int $currencyId): Builder
    {
        return $this->builder->whereCurrencyId($currencyId);
    }

    /**
     * Filter by Currency Ids.
     *
     * @param array $currencyId Currency Ids.
     *
     * @return Builder
     */
    protected function currencyIds(array $currencyId): Builder
    {
        return $this->builder->whereCurrencyIdIn($currencyId);
    }
}
