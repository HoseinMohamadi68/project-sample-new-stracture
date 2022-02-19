<?php

namespace App\Traits;

use Carbon\Traits\Date;
use Illuminate\Database\Eloquent\Builder;

trait HasStartedAtTrait
{
    /**
     * @param Builder $builder Builder.
     * @param string  $date    Started At.
     *
     * @return Builder
     */
    public function scopeWhereStartedAtIs(Builder $builder, string $date): Builder
    {
        return $builder->where(self::STARTED_AT, $date);
    }

    /**
     * @param Builder $builder Builder.
     * @param string  $date    Started At.
     *
     * @return Builder
     */
    public function scopeWhereStartedAtGreaterThan(Builder $builder, string $date): Builder
    {
        return $builder->where(self::STARTED_AT, '>=', $date);
    }

    /**
     * @param Builder $builder Builder.
     * @param string  $date    Started At.
     *
     * @return Builder
     */
    public function scopeWhereStartedAtLessThan(Builder $builder, string $date): Builder
    {
        return $builder->where(self::STARTED_AT, '<=', $date);
    }
}
