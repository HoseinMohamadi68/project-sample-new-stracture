<?php

namespace App\Interfaces\Traits;

use Illuminate\Database\Eloquent\Builder;

interface HasLatitudeInterface
{
    /**
     * @param Builder $builder  Builder.
     * @param float   $latitude Latitude.
     *
     * @return Builder
     */
    public function scopeWhereLatitudeGreaterThan(Builder $builder, float $latitude): Builder;

    /**
     * @param Builder $builder  Builder.
     * @param float   $latitude Latitude.
     *
     * @return Builder
     */
    public function scopeWhereLatitudeLessThan(Builder $builder, float $latitude): Builder;
}
