<?php

namespace App\Traits\Filters;

use Illuminate\Database\Eloquent\Builder;

trait FilterIso3Trait
{
    /**
     * Filter by Iso3.
     *
     * @param string $iso3 Iso3.
     *
     * @return Builder
     */
    protected function iso3(string $iso3): Builder
    {
        return $this->builder->whereIso3Like($iso3);
    }
}
