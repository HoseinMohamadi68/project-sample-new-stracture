<?php

namespace App\Interfaces\Traits;

use Illuminate\Database\Eloquent\Builder;

interface HasSymbolInterface
{
    /**
     * @param Builder $builder Builder.
     * @param string  $symbol  Symbol.
     *
     * @return Builder
     */
    public function scopeWhereSymbolLike(Builder $builder, string $symbol): Builder;
}
