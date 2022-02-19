<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasCountTrait
{
    /**
     * @param Builder $builder Builder.
     * @param integer $count   Count.
     *
     * @return Builder
     */
    public function scopeWhereCountGreaterThan(Builder $builder, int $count): Builder
    {
        return $builder->where(self::COUNT, '>=', $count);
    }

    /**
     * @param Builder $builder Builder.
     * @param integer $count   Count.
     *
     * @return Builder
     */
    public function scopeWhereCountLessThan(Builder $builder, int $count): Builder
    {
        return $builder->where(self::COUNT, '<=', $count);
    }

    /**
     * @param Builder $builder Builder.
     * @param integer $count   Count.
     *
     * @return Builder
     */
    public function scopeWhereCountIs(Builder $builder, int $count): Builder
    {
        return $builder->where(self::COUNT, $count);
    }
}
