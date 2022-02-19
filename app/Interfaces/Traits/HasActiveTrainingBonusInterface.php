<?php

namespace App\Interfaces\Traits;

use Illuminate\Database\Eloquent\Builder;

interface HasActiveTrainingBonusInterface
{
    /**
     * @param Builder $builder Builder.
     *
     * @return Builder
     */
    public function scopeWhereHasActiveTrainingBonus(Builder $builder): Builder;

    /**
     * @param Builder $builder Builder.
     *
     * @return Builder
     */
    public function scopeWhereHasNotActiveTrainingBonus(Builder $builder): Builder;
}
