<?php

namespace App\Interfaces\Traits;

use Illuminate\Database\Eloquent\Builder;

interface HasIso2Interface
{

    const ISO2 = 'iso_2';
    /**
     * @param Builder $builder Builder.
     * @param string  $iso2    ISO2.
     *
     * @return Builder
     */
    public function scopeWhereIso2Like(Builder $builder, string $iso2): Builder;

    /**
     * @param Builder $builder Builder.
     * @param string  $iso2    ISO2.
     *
     * @return Builder
     */
    public function scopeOrWhereIso2Like(Builder $builder, string $iso2): Builder;
}
