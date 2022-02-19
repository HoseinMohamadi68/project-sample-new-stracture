<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasPostDeliveryFactorTrait
{
    /**
     * @param Builder $builder Builder.
     *
     * @return Builder
     */
    public function scopeWherePostDeliveryFactor(Builder $builder): Builder
    {
        return $builder->where(self::POST_DELIVERY_FACTOR, true);
    }

    /**
     * @param Builder $builder Builder.
     *
     * @return Builder
     */
    public function scopeWhereHasNotPostDeliveryFactor(Builder $builder): Builder
    {
        return $builder->where(self::POST_DELIVERY_FACTOR, false);
    }
}
