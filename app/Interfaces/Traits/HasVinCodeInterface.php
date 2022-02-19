<?php

namespace App\Interfaces\Traits;

use Illuminate\Database\Eloquent\Builder;

interface HasVinCodeInterface
{
    /**
     * @param Builder $builder Builder.
     * @param string  $vinCode VIN Code.
     *
     * @return Builder
     */
    public function scopeWhereVinCodeLike(Builder $builder, string $vinCode): Builder;
}
