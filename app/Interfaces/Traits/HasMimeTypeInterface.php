<?php

namespace App\Interfaces\Traits;

use Illuminate\Database\Eloquent\Builder;

interface HasMimeTypeInterface
{
    /**
     * @param Builder $builder Builder.
     * @param string  $type    Type.
     *
     * @return Builder
     */
    public function scopeWhereMimeTypeIs(Builder $builder, string $type): Builder;
}
