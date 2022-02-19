<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasActiveAutoBonusTrait
{
    /**
     * @param Builder $builder Builder.
     *
     * @return Builder
     */
    public function scopeWhereHasActiveAutoBonus(Builder $builder): Builder
    {
        return $builder->where(self::ACTIVE_AUTO_BONUS, true);
    }

    /**
     * @param Builder $builder Builder.
     *
     * @return Builder
     */
    public function scopeWhereHasNotActiveAutoBonus(Builder $builder): Builder
    {
        return $builder->where(self::ACTIVE_AUTO_BONUS, false);
    }
}
