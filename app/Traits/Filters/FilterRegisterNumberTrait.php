<?php

namespace App\Traits\Filters;

use Illuminate\Database\Eloquent\Builder;

trait FilterRegisterNumberTrait
{
    /**
     * Filter by Register number.
     *
     * @param string $registerNumber Register number.
     *
     * @return Builder
     */
    protected function registerNumber(string $registerNumber): Builder
    {
        return $this->builder->whereRegisterNumberLike($registerNumber);
    }
}
