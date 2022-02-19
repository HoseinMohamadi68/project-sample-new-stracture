<?php

namespace App\Repositories\Currency;

use App\Models\Currency\Currency;

class CurrenciesRepo
{
    /**
     * @return boolean
     */
    public function getUpdateDeactivateAll(): bool
    {
        return Currency::query()->update([Currency::IS_DEFAULT => false]);
    }

    /**
     * @param Currency $currency Currency.
     *
     * @return boolean
     */
    public function getUpdate(Currency $currency): bool
    {
        return $currency->update([Currency::IS_DEFAULT => true]);
    }
}
