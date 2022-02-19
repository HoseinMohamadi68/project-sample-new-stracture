<?php

namespace App\Interfaces\Traits;

use Illuminate\Database\Eloquent\Builder;

interface HasRegionInterface
{
    /**
     * @param Builder $builder Builder.
     * @param string  $region  Region.
     *
     * @return Builder
     */
    public function scopeWhereRegionLike(Builder $builder, string $region): Builder;
}
