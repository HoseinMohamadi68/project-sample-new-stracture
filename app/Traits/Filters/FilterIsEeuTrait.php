<?php

namespace App\Traits\Filters;

use Illuminate\Database\Eloquent\Builder;

trait FilterIsEeuTrait
{
    /**
     * Filter By Is Eeu
     *
     * @param boolean $isEeu Is Eeu.
     *
     * @return Builder
     */
    protected function isEeu(bool $isEeu): Builder
    {
        return $this->builder->whereEeu($isEeu);
    }
}
