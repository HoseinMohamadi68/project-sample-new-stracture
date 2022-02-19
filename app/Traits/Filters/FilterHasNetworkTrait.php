<?php

namespace App\Traits\Filters;

use Illuminate\Database\Eloquent\Builder;

trait FilterHasNetworkTrait
{
    /**
     * @param boolean $hasNetwork Has SaleSystem.
     * @return Builder
     */
    public function hasNetwork($hasNetwork): Builder // phpcs:ignore
    {
        if (is_string($hasNetwork)) {
            $hasNetwork = $hasNetwork === 'true';
        }
        if ($hasNetwork) {
            return $this->builder->whereHasNetwork();
        }

        return $this->builder->whereHasNotNetwork();
    }
}
