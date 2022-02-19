<?php

namespace App\Traits\Filters;

use Illuminate\Database\Eloquent\Builder;

trait FilterAddressTrait
{
    /**
     * Filter by name.
     *
     * @param string $textAddress Name.
     *
     * @return Builder
     */
    protected function textAddress(string $textAddress): Builder
    {
        return $this->builder->whereTextAddressLike($textAddress);
    }
}
