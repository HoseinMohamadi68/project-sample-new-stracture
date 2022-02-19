<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasCanSeeDownLineTrait
{
    /**
     * @param Builder $builder Builder.
     *
     * @return Builder
     */
    public function scopeWhereHasCanSeeDownLine(Builder $builder): Builder
    {
        return $builder->where(self::CAN_SEE_DOWN_LINE, true);
    }

    /**
     * @param Builder $builder Builder.
     *
     * @return Builder
     */
    public function scopeWhereHasNotCanSeeDownLine(Builder $builder): Builder
    {
        return $builder->where(self::CAN_SEE_DOWN_LINE, false);
    }
}
