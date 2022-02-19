<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasBtobTrait
{
    /**
     * @param Builder $builder Builder.
     *
     * @return Builder
     */
    public function scopeWhereHasBtob(Builder $builder): Builder
    {
        return $builder->where(self::HAS_BTOB, true);
    }

    /**
     * @param Builder $builder Builder.
     *
     * @return Builder
     */
    public function scopeWhereHasNotBtob(Builder $builder): Builder
    {
        return $builder->where(self::HAS_BTOB, false);
    }
}
