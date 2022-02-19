<?php

namespace App\Traits\Filters;

use Illuminate\Database\Eloquent\Builder;

trait FilterConsigneeMobileTrait
{
    /**
     * @param string $consigneeMobile ConsigneeMobile.
     *
     * @return Builder
     */
    protected function consigneeMobile(string $consigneeMobile): Builder
    {
        return $this->builder->whereConsigneeMobileLike($consigneeMobile);
    }
}
