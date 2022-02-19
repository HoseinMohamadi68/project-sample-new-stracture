<?php

namespace App\Interfaces\Traits;

use Illuminate\Database\Eloquent\Builder;

interface IsSyncedInterface
{
    /**
     * @param Builder $builder Builder.
     *
     * @return Builder
     */
    public function scopeWhereSynced(Builder $builder): Builder;

    /**
     * @param Builder $builder Builder.
     *
     * @return Builder
     */
    public function scopeWhereNotSynced(Builder $builder): Builder;
}
