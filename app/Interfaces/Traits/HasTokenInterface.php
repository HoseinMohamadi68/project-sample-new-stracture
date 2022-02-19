<?php

namespace App\Interfaces\Traits;

use Illuminate\Database\Eloquent\Builder;

interface HasTokenInterface
{
    /**
     * @param Builder $builder Builder.
     * @param string  $token   Token.
     *
     * @return Builder
     */
    public function scopeWhereTokenStringIs(Builder $builder, string $token): Builder;
}
