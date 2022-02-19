<?php

namespace App\Traits\Filters;

use Illuminate\Database\Eloquent\Builder;

trait FilterResponsibilityTrait
{
    /**
     * @param string $responsibility License Type.
     *
     * @return Builder
     */
    public function responsibility(string $responsibility): Builder
    {
        return $this->builder->whereResponsibilityIs($responsibility);
    }
}
