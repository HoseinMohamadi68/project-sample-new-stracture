<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasIsDefaultTrait
{
    /**
     * @param Builder $builder Builder.
     *
     * @return Builder
     */
    public function scopeWhereDefault(Builder $builder): Builder
    {
        return $builder->whereIsDefault(true);
    }

    /**
     * @param Builder $builder Builder.
     *
     * @return Builder
     */
    public function scopeWhereNotDefault(Builder $builder): Builder
    {
        return $builder->whereIsDefault(false);
    }
}
