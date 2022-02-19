<?php

namespace App\Traits\Filters;

use Illuminate\Database\Eloquent\Builder;

trait FilterStatusTrait
{
    /**
     * @param string $status Status.
     *
     * @return Builder
     */
    public function status(string $status): Builder
    {
        return $this->builder->whereStatusIs($status);
    }

    /**
     * @param array $statuses Status.
     *
     * @return Builder
     */
    public function statusIn(array $statuses): Builder
    {
        return $this->builder->whereStatusIn($statuses);
    }

    /**
     * @param array $statuses Status.
     *
     * @return Builder
     */
    public function statusNotIn(array $statuses): Builder
    {
        return $this->builder->whereStatusNotIn($statuses);
    }
}
