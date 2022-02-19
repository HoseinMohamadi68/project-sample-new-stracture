<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasIso3Trait
{
    /**
     * @param Builder $builder Builder.
     * @param string  $iso3    ISO3.
     *
     * @return Builder
     */
    public function scopeWhereIso3Like(Builder $builder, string $iso3): Builder
    {
        return $builder->where(self::ISO3, 'like', "%$iso3%");
    }

    /**
     * @param Builder $builder Builder.
     * @param string  $iso3    ISO3.
     *
     * @return Builder
     */
    public function scopeOrWhereIso3Like(Builder $builder, string $iso3): Builder
    {
        return $builder->orWhere(self::ISO3, 'like', "%$iso3%");
    }
}
