<?php

namespace App\Traits\Filters;

use Illuminate\Database\Eloquent\Builder;

trait FilterRegisterOfficeTrait
{
    /**
     * Filter by Register Office
     *
     * @param string $registerOffice Register Office.
     *
     * @return Builder
     */
    protected function registerOffice(string $registerOffice): Builder
    {
        return $this->builder->whereRegisterOfficeLike($registerOffice);
    }
}
