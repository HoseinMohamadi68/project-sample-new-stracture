<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasSizeTrait
{
    /**
     * @param Builder $builder Builder.
     * @param integer $size    Size.
     *
     * @return Builder
     */
    public function scopeWhereSizeGreaterThan(Builder $builder, int $size): Builder
    {
        return $builder->where(self::SIZE, '>=', $size);
    }

    /**
     * @param Builder $builder Builder.
     * @param integer $size    Size.
     *
     * @return Builder
     */
    public function scopeWhereSizeLessThan(Builder $builder, int $size): Builder
    {
        return $builder->where(self::SIZE, '<=', $size);
    }
}
