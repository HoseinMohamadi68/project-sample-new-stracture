<?php

namespace App\Traits\Filters;

use Illuminate\Database\Eloquent\Builder;

trait FilterFatherTrait
{
    /**
     * Filter by Father.
     *
     * @param string $father Father.
     *
     * @return Builder
     */
    protected function father(string $father): Builder
    {
        return $this->builder->whereFatherLike($father);
    }
}
