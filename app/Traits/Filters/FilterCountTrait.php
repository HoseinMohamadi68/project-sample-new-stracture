<?php

namespace App\Traits\Filters;

use Illuminate\Database\Eloquent\Builder;

trait FilterCountTrait
{
    /**
     * Filter by Count.
     *
     * @param integer $count Count.
     *
     * @return Builder
     */
    protected function count(int $count): Builder
    {
        return $this->builder->whereCountIs($count);
    }

    /**
     * Filter by Count.
     *
     * @param integer $count Count.
     *
     * @return Builder
     */
    protected function countGreaterThan(int $count): Builder
    {
        return $this->builder->whereCountGreaterThan($count);
    }

    /**
     * Filter by Count.
     *
     * @param integer $count Count.
     *
     * @return Builder
     */
    protected function countLessThan(int $count): Builder
    {
        return $this->builder->whereCountLessThan($count);
    }
}
