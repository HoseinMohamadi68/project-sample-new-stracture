<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasOverPersonalTurnoverTrait
{
    /**
     * @param Builder $builder Builder.
     *
     * @return Builder
     */
    public function scopeWhereHasOverPersonalTurnover(Builder $builder): Builder
    {
        return $builder->where(self::OVER_PERSONAL_TURNOVER, true);
    }

    /**
     * @param Builder $builder Builder.
     *
     * @return Builder
     */
    public function scopeWhereHasNotOverPersonalTurnover(Builder $builder): Builder
    {
        return $builder->where(self::OVER_PERSONAL_TURNOVER, false);
    }
}
