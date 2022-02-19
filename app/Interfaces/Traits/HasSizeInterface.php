<?php

namespace App\Interfaces\Traits;

use Illuminate\Database\Eloquent\Builder;

interface HasSizeInterface
{
    /**
     * @param Builder $builder Builder.
     * @param integer $size    Size.
     *
     * @return Builder
     */
    public function scopeWhereSizeGreaterThan(Builder $builder, int $size): Builder;

    /**
     * @param Builder $builder Builder.
     * @param integer $size    Size.
     *
     * @return Builder
     */
    public function scopeWhereSizeLessThan(Builder $builder, int $size): Builder;
}
