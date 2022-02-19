<?php

namespace App\Traits\Filters;

use Illuminate\Database\Eloquent\Builder;

trait FilterContractNumberTrait
{
    /**
     * Filter by ContractNumber.
     *
     * @param string $contractNumber ContractNumber.
     *
     * @return Builder
     */
    protected function contractNumber(string $contractNumber): Builder
    {
        return $this->builder->whereContractNumberIs($contractNumber);
    }

    /**
     * Filter by ContractNumber.
     *
     * @param string $contractNumber ContractNumber.
     *
     * @return Builder
     */
    protected function contractNumberLike(string $contractNumber): Builder
    {
        return $this->builder->whereContractNumberLike($contractNumber);
    }
}
