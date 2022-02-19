<?php

namespace App\Interfaces\Traits;

use Illuminate\Database\Eloquent\Builder;

interface HasSwiftInterface
{
    /**
     * @param Builder $builder Builder.
     * @param string  $swift   Swift.
     *
     * @return Builder
     */
    public function scopeWhereSwiftLike(Builder $builder, string $swift): Builder;
}
