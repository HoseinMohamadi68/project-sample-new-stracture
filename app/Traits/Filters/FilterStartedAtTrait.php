<?php

namespace App\Traits\Filters;

use Illuminate\Database\Eloquent\Builder;

trait FilterStartedAtTrait
{
    /**
     * Filter by Started At.
     *
     * @param string $startedAt Started At.
     *
     * @return Builder
     */
    protected function startedAt(string $startedAt): Builder
    {
        return $this->builder->whereStartedAtIs($startedAt);
    }

    /**
     * Filter by Started At.
     *
     * @param string $startedAt Started At.
     *
     * @return Builder
     */
    public function startedAtGreaterThan(string $startedAt): Builder
    {
        return $this->builder->whereStartedAtGreaterThan($startedAt);
    }

    /**
     * Filter by Started At.
     *
     * @param string $startedAt Started At.
     *
     * @return Builder
     */
    public function startedAtLessThan(string $startedAt): Builder
    {
        return $this->builder->whereStartedAtLessThan($startedAt);
    }
}
