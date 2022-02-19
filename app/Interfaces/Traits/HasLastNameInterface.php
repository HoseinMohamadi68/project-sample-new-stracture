<?php

namespace App\Interfaces\Traits;

use Illuminate\Database\Eloquent\Builder;

interface HasLastNameInterface
{
    /**
     * @param Builder $builder  Builder.
     * @param string  $lastName Last Name.
     *
     * @return Builder
     */
    public function scopeWhereLastNameLike(Builder $builder, string $lastName): Builder;

    /**
     * @param Builder $builder  Builder.
     * @param string  $lastName Last Name.
     *
     * @return Builder
     */
    public function scopeOrWhereLastNameLike(Builder $builder, string $lastName): Builder;
}
