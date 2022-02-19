<?php

namespace App\Interfaces\Traits;

use Illuminate\Database\Eloquent\Builder;

interface HasPathInterface
{
    /**
     * @param Builder $builder Builder.
     * @param string  $path    Path.
     *
     * @return Builder
     */
    public function scopeWherePathIs(Builder $builder, string $path): Builder;
}
