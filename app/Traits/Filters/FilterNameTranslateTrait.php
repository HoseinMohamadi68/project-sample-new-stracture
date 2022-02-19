<?php

namespace App\Traits\Filters;

use Illuminate\Database\Eloquent\Builder;

trait FilterNameTranslateTrait
{
    /**
     * Filter By Name.
     *
     * @param string $name Name.
     * @return Builder
     */
    public function name(string $name): Builder
    {
        return $this->builder->whereHas('translations', function ($query) use ($name) {
            return $query->whereTitleLike($name);
        });
    }
}
