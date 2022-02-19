<?php

namespace App\Traits\Filters;

use Illuminate\Database\Eloquent\Builder;

trait FilterSlugTrait
{
    /**
     * Filter by slug.
     *
     * @param string $slug Slug.
     *
     * @return Builder
     */
    protected function slug(string $slug): Builder
    {
        return $this->builder->whereslugLike($slug);
    }
}
