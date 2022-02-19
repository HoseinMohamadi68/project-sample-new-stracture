<?php

namespace App\Interfaces\Traits;

use Illuminate\Database\Eloquent\Builder;

interface HasMaxClientRootInterface
{
    /**
     * @param Builder $builder       Builder.
     * @param integer $maxClientRoot Max Client Root.
     *
     * @return Builder
     */
    public function scopeWhereMaxClientRootGreaterThan(Builder $builder, int $maxClientRoot): Builder;

    /**
     * @param Builder $builder       Builder.
     * @param integer $maxClientRoot Max Client Root.
     *
     * @return Builder
     */
    public function scopeWhereMaxClientRootLessThan(Builder $builder, int $maxClientRoot): Builder;
}
