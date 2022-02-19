<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasActiveTrainingBonusTrait
{
    /**
     * @param Builder $builder Builder.
     *
     * @return Builder
     */
    public function scopeWhereHasActiveTrainingBonus(Builder $builder): Builder
    {
        return $builder->where(self::ACTIVE_TRAINING_BONUS, true);
    }

    /**
     * @param Builder $builder Builder.
     *
     * @return Builder
     */
    public function scopeWhereHasNotActiveTrainingBonus(Builder $builder): Builder
    {
        return $builder->where(self::ACTIVE_TRAINING_BONUS, false);
    }
}
