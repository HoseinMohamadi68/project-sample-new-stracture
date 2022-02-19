<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasNumberTrait
{
    /**
     * @param Builder $builder Builder.
     * @param string  $number  Number.
     *
     * @return Builder
     */
    public function scopeWhereNumberLike(Builder $builder, string $number): Builder
    {
        return $builder->where(self::NUMBER, 'like', "%$number%");
    }
}
