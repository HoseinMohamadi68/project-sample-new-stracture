<?php

namespace App\Interfaces\Traits;

use Illuminate\Database\Eloquent\Builder;

interface HasIdInterface
{
    /**
     * @param Builder $builder Builder.
     * @param array   $ids     IDs.
     *
     * @return Builder
     */
    public function scopeWhereIdIn(Builder $builder, array $ids): Builder;
}
