<?php

namespace App\Traits\Filters;

use Illuminate\Database\Eloquent\Builder;

trait FilterLatitudeTrait
{
    /**
     * Filter by Greater Than Latitude.
     *
     * @param string $latitude Latitude.
     *
     * @return Builder
     */
    public function latitudeGreaterThan(string $latitude): Builder
    {
        return $this->builder->whereLatitudeGreaterThan($latitude);
    }

    /**
     * Filter by Less Than Latitude.
     *
     * @param string $latitude Latitude.
     *
     * @return Builder
     */
    public function latitudeLessThan(string $latitude): Builder
    {
        return $this->builder->whereLatitudeLessThan($latitude);
    }
}
