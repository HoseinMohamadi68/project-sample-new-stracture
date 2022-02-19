<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasLocaleTrait
{
    /**
     * @param Builder $builder Builder.
     * @param string  $locale  Name.
     *
     * @return Builder
     */
    public function scopeWhereLocaleLike(Builder $builder, string $locale): Builder
    {
        return $builder->where(self::LOCALE, 'like', "%$locale%");
    }
}
