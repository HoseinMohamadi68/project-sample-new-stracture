<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasTokenTrait
{
    /**
     * @param Builder $builder Builder.
     * @param string  $token   Token.
     *
     * @return Builder
     */
    public function scopeWhereTokenStringIs(Builder $builder, string $token): Builder
    {
        return $builder->where(self::TOKEN_STRING, $token);
    }
}
