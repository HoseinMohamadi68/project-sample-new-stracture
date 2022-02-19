<?php

namespace App\Traits\Filters;

use Illuminate\Database\Eloquent\Builder;

trait FilterTypeTrait
{
    /**
     * @param string $type Type.
     *
     * @return Builder
     */
    protected function type(string $type): Builder
    {
        return $this->builder->whereTypeIs($type);
    }
}
