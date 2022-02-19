<?php

namespace App\Interfaces\Traits;

use Illuminate\Database\Eloquent\Builder;

interface HasNameInterface
{
    const NAME = 'name';

    /**
     * @param Builder $builder Builder.
     * @param string  $name    Name.
     *
     * @return Builder
     */
    public function scopeWhereNameLike(Builder $builder, string $name): Builder;
}
