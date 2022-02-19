<?php

namespace App\Traits\Filters;

use Illuminate\Database\Eloquent\Builder;

trait FilterCompanySerialIdTrait
{
    /**
    * Filter by Company Serial Id .
    *
    * @param integer $companySerialId Company Serial Id .
    *
    * @return Builder
    */
    protected function companySerialId(int $companySerialId): Builder
    {
        return $this->builder->whereCompanySerialIdIs($companySerialId);
    }

    /**
     * Filter by Company Serial Ids.
     *
     * @param array $companySerialIdIn Company Serial Ids.
     *
     * @return Builder
     */
    protected function companySerialIdIn(array $companySerialIdIn): Builder
    {
        return $this->builder->whereCompanySerialIdIn($companySerialIdIn);
    }
}
