<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasLatitudeTrait
{
    /**
     * @param Builder $builder  Builder.
     * @param float   $latitude Latitude.
     *
     * @return Builder
     */
    public function scopeWhereLatitudeGreaterThan(Builder $builder, float $latitude): Builder
    {
        return $builder->where(self::LATITUDE, '>=', $latitude);
    }

    /**
     * @param Builder $builder  Builder.
     * @param float   $latitude Latitude.
     *
     * @return Builder
     */
    public function scopeWhereLatitudeLessThan(Builder $builder, float $latitude): Builder
    {
        return $builder->where(self::LATITUDE, '<=', $latitude);
    }
}
