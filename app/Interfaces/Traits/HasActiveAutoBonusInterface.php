<?php

namespace App\Interfaces\Traits;

use Illuminate\Database\Eloquent\Builder;

interface HasActiveAutoBonusInterface
{
    /**
     * @param Builder $builder Builder.
     *
     * @return Builder
     */
    public function scopeWhereHasActiveAutoBonus(Builder $builder): Builder;

    /**
     * @param Builder $builder Builder.
     *
     * @return Builder
     */
    public function scopeWhereHasNotActiveAutoBonus(Builder $builder): Builder;
}
