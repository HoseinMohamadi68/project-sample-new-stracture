<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasDeliveryTrait
{
    /**
     * @param Builder $builder Builder.
     *
     * @return Builder
     */
    public function scopeWhereHasDelivery(Builder $builder): Builder
    {
        return $builder->where(self::HAS_DELIVERY, true);
    }

    /**
     * @param Builder $builder Builder.
     *
     * @return Builder
     */
    public function scopeWhereHasNotDelivery(Builder $builder): Builder
    {
        return $builder->where(self::HAS_DELIVERY, false);
    }
}
