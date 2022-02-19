<?php

namespace App\Interfaces\Traits;

use Illuminate\Database\Eloquent\Builder;

interface HasDeliveryInterface
{
    /**
     * @param Builder $builder Builder.
     *
     * @return Builder
     */
    public function scopeWhereHasDelivery(Builder $builder): Builder;

    /**
     * @param Builder $builder Builder.
     *
     * @return Builder
     */
    public function scopeWhereHasNotDelivery(Builder $builder): Builder;
}
