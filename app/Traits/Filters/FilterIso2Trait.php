<?php

namespace App\Traits\Filters;

use Illuminate\Database\Eloquent\Builder;

trait FilterIso2Trait
{
    /**
     * Filter by Iso2.
     *
     * @param string $iso2 Iso2.
     *
     * @return Builder
     */
    protected function iso2(string $iso2): Builder
    {
        return $this->builder->whereIso2Like($iso2);
    }
}
