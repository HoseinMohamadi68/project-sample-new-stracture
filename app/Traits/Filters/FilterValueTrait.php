<?php

namespace App\Traits\Filters;

use Illuminate\Database\Eloquent\Builder;

trait FilterValueTrait
{
    /**
     * Filter by Value.
     *
     * @param integer $value Value.
     *
     * @return Builder
     */
    protected function value(int $value): Builder
    {
        return $this->builder->whereValueIs($value);
    }

    /**
     * Filter by Value.
     *
     * @param integer $value Value.
     *
     * @return Builder
     */
    protected function valueGreaterThan(int $value): Builder
    {
        return $this->builder->whereValueGreaterThan($value);
    }

    /**
     * Filter by Value.
     *
     * @param integer $value Value.
     *
     * @return Builder
     */
    protected function valueLessThan(int $value): Builder
    {
        return $this->builder->whereValueLessThan($value);
    }
}
