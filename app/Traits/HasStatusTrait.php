<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasStatusTrait
{
    /**
     * @param Builder $builder Builder.
     * @param string  $status  Status.
     *
     * @return Builder
     */
    public function scopeWhereStatusIs(Builder $builder, string $status): Builder
    {
        return $builder->where(self::STATUS, $status);
    }

    /**
     * @param Builder $builder  Builder.
     * @param array   $statuses Statuses.
     *
     * @return Builder
     */
    public function scopeWhereStatusIn(Builder $builder, array $statuses): Builder
    {
        return $builder->whereIn(self::STATUS, $statuses);
    }


    /**
     * @param Builder $builder  Builder.
     * @param array   $statuses Statuses.
     *
     * @return Builder
     */
    public function scopeWhereStatusNotIn(Builder $builder, array $statuses): Builder
    {
        return $builder->whereNotIn(self::STATUS, $statuses);
    }
}
