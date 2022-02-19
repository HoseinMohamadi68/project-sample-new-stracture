<?php

namespace App\Traits\Filters;

use Illuminate\Database\Eloquent\Builder;

trait FilterDescriptionTrait
{
    /**
     * Filter by Description.
     *
     * @param string $description Description.
     *
     * @return Builder
     */
    protected function description(string $description): Builder
    {
        return $this->builder->whereDescriptionLike($description);
    }
}
