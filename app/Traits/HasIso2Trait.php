<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasIso2Trait
{
    /**
     * @param Builder $builder Builder.
     * @param string  $iso2    ISO2.
     *
     * @return Builder
     */
    public function scopeWhereIso2Like(Builder $builder, string $iso2): Builder
    {
        return $builder->where(self::ISO2, 'like', "%$iso2%");
    }

    /**
     * @param Builder $builder Builder.
     * @param string  $iso2    ISO2.
     *
     * @return Builder
     */
    public function scopeOrWhereIso2Like(Builder $builder, string $iso2): Builder
    {
        return $builder->orWhere(self::ISO2, 'like', "%$iso2%");
    }
}
