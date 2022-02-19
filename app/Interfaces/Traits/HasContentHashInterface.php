<?php

namespace App\Interfaces\Traits;

use Illuminate\Database\Eloquent\Builder;

interface HasContentHashInterface
{
    /**
     * @param Builder $builder Builder.
     * @param string  $hash    Content hash.
     *
     * @return Builder
     */
    public function scopeWhereContentHashIs(Builder $builder, string $hash): Builder;
}
