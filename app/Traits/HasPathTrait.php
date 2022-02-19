<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasPathTrait
{
    /**
     * @param Builder $builder Builder.
     * @param string  $path    Path.
     *
     * @return Builder
     */
    public function scopeWherePathIs(Builder $builder, string $path): Builder
    {
        return $builder->where(self::PATH, $path);
    }
}
