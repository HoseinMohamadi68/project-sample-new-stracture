<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasTypeTrait
{
    /**
     * @param Builder $builder Builder.
     * @param string  $type    Type.
     *
     * @return Builder
     */
    public function scopeWhereTypeIs(Builder $builder, string $type): Builder
    {
        return $builder->where(self::TYPE, $type);
    }

    /**
     * @param Builder $builder Builder.
     * @param string  $type    Type.
     *
     * @return Builder
     */
    public function scopeOrWhereTypeIs(Builder $builder, string $type): Builder
    {
        return $builder->orWhere(self::TYPE, $type);
    }
}
