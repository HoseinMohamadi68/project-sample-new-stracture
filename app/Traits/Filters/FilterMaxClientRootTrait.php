<?php

namespace App\Traits\Filters;

use Illuminate\Database\Eloquent\Builder;

trait FilterMaxClientRootTrait
{
    /**
     * Filter by Max Client Root.
     *
     * @param integer $maxClientRoot Max Client Root.
     *
     * @return Builder
     */
    protected function maxClientRoot(int $maxClientRoot): Builder
    {
        return $this->builder->whereMaxClientRoot($maxClientRoot);
    }

    /**
     * Filter by Max Client Root.
     *
     * @param integer $maxClientRoot Max Client Root.
     *
     * @return Builder
     */
    protected function maxClientRootGreaterThan(int $maxClientRoot): Builder
    {
        return $this->builder->whereMaxClientRootGreaterThan($maxClientRoot);
    }

    /**
     * Filter by Max Client Root.
     *
     * @param integer $maxClientRoot Max Client Root.
     *
     * @return Builder
     */
    protected function maxClientRootLessThan(int $maxClientRoot): Builder
    {
        return $this->builder->whereMaxClientRootLessThan($maxClientRoot);
    }
}
