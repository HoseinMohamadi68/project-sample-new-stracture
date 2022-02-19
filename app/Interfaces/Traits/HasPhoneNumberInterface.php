<?php

namespace App\Interfaces\Traits;

use Illuminate\Database\Eloquent\Builder;

interface HasPhoneNumberInterface
{
    const NUMBER = 'number';

    /**
     * @param Builder $builder Builder.
     * @param string  $Number  Number.
     *
     * @return Builder
     */
    public function scopeWhereNumberLike(Builder $builder, string $Number): Builder;
}
