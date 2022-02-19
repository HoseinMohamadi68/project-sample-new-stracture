<?php

namespace App\Traits\Filters;

use Illuminate\Database\Eloquent\Builder;

trait FilterNameTrait
{
    /**
     * Filter by name.
     *
     * @param string $name Name.
     *
     * @return Builder
     */
    protected function name(string $name): Builder
    {
        return $this->builder->whereNameLike($name);
    }
}
