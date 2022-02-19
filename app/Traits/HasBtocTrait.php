<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasBtocTrait
{
    /**
     * @param Builder $builder Builder.
     *
     * @return Builder
     */
    public function scopeWhereHasBtoc(Builder $builder): Builder
    {
        return $builder->where(self::HAS_BTOC, true);
    }

    /**
     * @param Builder $builder Builder.
     *
     * @return Builder
     */
    public function scopeWhereHasNotBtoc(Builder $builder): Builder
    {
        return $builder->where(self::HAS_BTOC, false);
    }
}
