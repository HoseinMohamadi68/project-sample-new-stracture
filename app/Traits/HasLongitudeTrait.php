<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasLongitudeTrait
{
    /**
     * @param Builder $builder   Builder.
     * @param float   $longitude Longitude.
     *
     * @return Builder
     */
    public function scopeWhereLongitudeGreaterThan(Builder $builder, float $longitude): Builder
    {
        return $builder->where(self::LONGITUDE, '>=', $longitude);
    }

    /**
     * @param Builder $builder   Builder.
     * @param float   $longitude Longitude.
     *
     * @return Builder
     */
    public function scopeWhereLongitudeLessThan(Builder $builder, float $longitude): Builder
    {
        return $builder->where(self::LONGITUDE, '<=', $longitude);
    }
}
