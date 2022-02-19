<?php

namespace App\Traits\Filters;

use Illuminate\Database\Eloquent\Builder;

trait FilterCityIdTrait
{
    /**
     * Filter by CityId.
     *
     * @param integer $cityId CityId.
     *
     * @return Builder
     */
    protected function cityId(int $cityId): Builder
    {
        return $this->builder->whereCityIdIs($cityId);
    }
}
