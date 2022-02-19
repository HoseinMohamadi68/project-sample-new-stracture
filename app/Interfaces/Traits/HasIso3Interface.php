<?php

namespace App\Interfaces\Traits;

use Illuminate\Database\Eloquent\Builder;

interface HasIso3Interface
{
    const ISO3 = 'iso_3';

    /**
     * @param Builder $builder Builder.
     * @param string  $iso3    Iso3.
     *
     * @return Builder
     */
    public function scopeWhereIso3Like(Builder $builder, string $iso3): Builder;

    /**
     * @param Builder $builder Builder.
     * @param string  $iso3    Iso3.
     *
     * @return Builder
     */
    public function scopeOrWhereIso3Like(Builder $builder, string $iso3): Builder;
}
