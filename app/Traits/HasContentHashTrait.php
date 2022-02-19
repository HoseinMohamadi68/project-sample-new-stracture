<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasContentHashTrait
{
    /**
     * @param Builder $builder Builder.
     * @param string  $hash    Content hash.
     *
     * @return Builder
     */
    public function scopeWhereContentHashIs(Builder $builder, string $hash): Builder
    {
        return $builder->where(self::CONTENT_HASH, $hash);
    }
}
