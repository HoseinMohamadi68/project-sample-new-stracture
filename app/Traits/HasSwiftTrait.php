<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasSwiftTrait
{
    /**
     * @param Builder $builder Builder.
     * @param string  $swift   Swift.
     *
     * @return Builder
     */
    public function scopeWhereSwiftLike(Builder $builder, string $swift): Builder
    {
        return $builder->where(self::SWIFT, 'like', "%$swift%");
    }
}
