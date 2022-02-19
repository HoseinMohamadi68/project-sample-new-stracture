<?php

namespace App\Traits\Filters;

use Illuminate\Database\Eloquent\Builder;

trait FilterProvinceIdTrait
{
    /**
     * Filter by ProvinceId.
     *
     * @param integer $provinceId ProvinceId.
     *
     * @return Builder
     */
    protected function provinceId(int $provinceId): Builder
    {
        return $this->builder->whereProvinceIdIs($provinceId);
    }

    /**
     * Filter by ProvinceId.
     *
     * @param array $provinceId ProvinceId.
     *
     * @return Builder
     */
    protected function provinceIds(array $provinceId): Builder
    {
        return $this->builder->whereProvinceIdIn($provinceId);
    }
}
