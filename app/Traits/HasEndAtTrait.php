<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasEndAtTrait
{
    /**
     * @param Builder $builder Builder.
     * @param string  $date    END_AT At.
     *
     * @return Builder
     */
    public function scopeWhereEndAtIs(Builder $builder, string $date): Builder
    {
        return $builder->where(self::END_AT, $date);
    }

    /**
     * @param Builder $builder Builder.
     * @param string  $date    END_AT At.
     *
     * @return Builder
     */
    public function scopeWhereEndAtGreaterThan(Builder $builder, string $date): Builder
    {
        return $builder->where(self::END_AT, '>=', $date);
    }

    /**
     * @param Builder $builder Builder.
     * @param string  $date    END_AT At.
     *
     * @return Builder
     */
    public function scopeWhereEndAtLessThan(Builder $builder, string $date): Builder
    {
        return $builder->where(self::END_AT, '<=', $date);
    }
}
