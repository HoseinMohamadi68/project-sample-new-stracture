<?php

namespace App\Traits\Filters;

use Illuminate\Database\Eloquent\Builder;

trait FilterSymbolTrait
{
    /**
     * Filter by Symbol.
     *
     * @param string $symbol Symbol.
     *
     * @return Builder
     */
    protected function symbol(string $symbol): Builder
    {
        return $this->builder->whereSymbol($symbol);
    }
}
