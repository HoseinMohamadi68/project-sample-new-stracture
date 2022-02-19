<?php

namespace App\Traits\Filters;

use Illuminate\Database\Eloquent\Builder;

trait FilterCompanyIdTrait
{
    /**
    * Filter by Company Id .
    *
    * @param integer $companyId Company Id .
    *
    * @return Builder
    */
    protected function companyId(int $companyId): Builder
    {
        return $this->builder->whereCompanyIdIs($companyId);
    }

    /**
     * Filter by Company Ids.
     *
     * @param array $companyIdIn Company Ids.
     *
     * @return Builder
     */
    protected function companyIdIn(array $companyIdIn): Builder
    {
        return $this->builder->whereCompanyIdIn($companyIdIn);
    }
}
