<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasReceiveCommissionTrait
{
    /**
     * @param Builder $builder Builder.
     *
     * @return Builder
     */
    public function scopeWhereHasReceiveCommission(Builder $builder): Builder
    {
        return $builder->where(self::RECEIVE_COMMISSION, true);
    }

    /**
     * @param Builder $builder Builder.
     *
     * @return Builder
     */
    public function scopeWhereHasNotReceiveCommission(Builder $builder): Builder
    {
        return $builder->where(self::RECEIVE_COMMISSION, false);
    }
}
