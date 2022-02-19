<?php

namespace App\Traits\Filters;

use Illuminate\Database\Eloquent\Builder;

trait FilterLongitudeTrait
{
    /**
     * Filter by Greater Than Longitude.
     *
     * @param string $longitude Longitude.
     *
     * @return Builder
     */
    public function longitudeGreaterThan(string $longitude): Builder
    {
        return $this->builder->whereLongitudeGreaterThan($longitude);
    }

    /**
     * Filter by Less Than Longitude.
     *
     * @param string $longitude Longitude.
     *
     * @return Builder
     */
    public function longitudeLessThan(string $longitude): Builder
    {
        return $this->builder->whereLongitudeLessThan($longitude);
    }
}
