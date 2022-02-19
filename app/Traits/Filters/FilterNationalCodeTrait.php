<?php

namespace App\Traits\Filters;

use Illuminate\Database\Eloquent\Builder;

trait FilterNationalCodeTrait
{
    /**
     * Filter by National Code.
     *
     * @param string $nationalCode National Code.
     *
     * @return Builder
     */
    protected function nationalCode(string $nationalCode): Builder
    {
        return $this->builder->whereNationalCodeLike($nationalCode);
    }
}
