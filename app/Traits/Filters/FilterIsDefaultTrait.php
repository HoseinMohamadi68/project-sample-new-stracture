<?php

namespace App\Traits\Filters;

use Illuminate\Database\Eloquent\Builder;

trait FilterIsDefaultTrait
{
    /**
     * @param boolean $isDefault IsDefault.
     *
     * @return Builder
     */
    protected function isDefault(bool $isDefault): Builder
    {
            return $this->builder->whereIsDefault($isDefault);
    }
}
