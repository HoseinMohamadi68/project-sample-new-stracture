<?php

namespace App\Traits\Filters;

use Illuminate\Database\Eloquent\Builder;

trait FilterCodeTrait
{
    /**
     * Filter by Cargo Type Id.
     *
     * @param string $code Cargo Type Id.
     *
     * @return Builder
     */
    protected function code(string $code): Builder
    {
        return $this->builder->whereCodeIs($code);
    }

    /**
     * Filter by Cargo Type Ids.
     *
     * @param array $codes Cargo Type Ids.
     *
     * @return Builder
     */
    protected function codeIn(array $codes): Builder
    {
        return $this->builder->whereCodeIn($codes);
    }
}
