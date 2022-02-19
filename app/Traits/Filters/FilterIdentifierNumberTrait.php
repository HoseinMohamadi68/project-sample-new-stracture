<?php

namespace App\Traits\Filters;

use Illuminate\Database\Eloquent\Builder;

trait FilterIdentifierNumberTrait
{
    /**
     * Filter by IdentifierNumber.
     *
     * @param integer $identifierNumber IdentifierNumber.
     *
     * @return Builder
     */
    protected function identifierNumber(int $identifierNumber): Builder
    {
        return $this->builder->whereIdentifierNumberIs($identifierNumber);
    }
}
