<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasNetworkTrait
{
    /**
     * @param Builder $builder Builder.
     *
     * @return Builder
     */
    public function scopeWhereHasNetwork(Builder $builder): Builder
    {
        return $builder->where(self::HAS_NETWORK, true);
    }

    /**
     * @param Builder $builder Builder.
     *
     * @return Builder
     */
    public function scopeWhereHasNotNetwork(Builder $builder): Builder
    {
        return $builder->where(self::HAS_NETWORK, false);
    }
}
