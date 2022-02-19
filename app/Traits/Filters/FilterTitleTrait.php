<?php

namespace App\Traits\Filters;

use Illuminate\Database\Eloquent\Builder;

trait FilterTitleTrait
{
    /**
     * Filter by Title.
     *
     * @param string $title Title.
     *
     * @return Builder
     */
    protected function title(string $title): Builder
    {
        return $this->builder->whereTitleLike($title);
    }
}
