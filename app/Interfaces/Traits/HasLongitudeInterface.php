<?php

namespace App\Interfaces\Traits;

use Illuminate\Database\Eloquent\Builder;

interface HasLongitudeInterface
{
    /**
     * @param Builder $builder   Builder.
     * @param float   $longitude Longitude.
     *
     * @return Builder
     */
    public function scopeWhereLongitudeGreaterThan(Builder $builder, float $longitude): Builder;

    /**
     * @param Builder $builder   Builder.
     * @param float   $longitude Longitude.
     *
     * @return Builder
     */
    public function scopeWhereLongitudeLessThan(Builder $builder, float $longitude): Builder;
}
