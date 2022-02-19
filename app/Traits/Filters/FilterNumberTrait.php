<?php

namespace App\Traits\Filters;

use Illuminate\Database\Eloquent\Builder;

trait FilterNumberTrait
{
    /**
     * @param string $number Number.
     *
     * @return Builder
     */
    protected function number(string $number): Builder
    {
        return $this->builder->whereNumberLike($number);
    }
}
