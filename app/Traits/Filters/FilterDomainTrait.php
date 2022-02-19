<?php

namespace App\Traits\Filters;

use Illuminate\Database\Eloquent\Builder;

trait FilterDomainTrait
{
    /**
     * Filter by Domain.
     *
     * @param string $domain Domain.
     *
     * @return Builder
     */
    protected function registerDomain(string $domain): Builder
    {
        return $this->builder->whereRegisterOfficeLike($domain);
    }
}
