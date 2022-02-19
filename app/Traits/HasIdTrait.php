<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasIdTrait
{
    /**
     * @param Builder $builder Builder.
     * @param array   $ids     IDs.
     *
     * @return Builder
     */
    public function scopeWhereIdIn(Builder $builder, array $ids): Builder
    {
        return $builder->whereIn(self::ID, $ids);
    }

    /**
     * @param Builder $builder Builder.
     * @param integer $id      IDs.
     *
     * @return Builder
     */
    public function scopeWhereIdIsNot(Builder $builder, int $id): Builder
    {
        return $builder->where(self::ID, '!=', $id);
    }
}
