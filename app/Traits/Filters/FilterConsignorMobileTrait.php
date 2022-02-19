<?php

namespace App\Traits\Filters;

use Illuminate\Database\Eloquent\Builder;

trait FilterConsignorMobileTrait
{
    /**
     * @param string $consignorMobile ConsignorMobile.
     *
     * @return Builder
     */
    protected function consignorMobile(string $consignorMobile): Builder
    {
        return $this->builder->whereConsignorMobileLike($consignorMobile);
    }
}
