<?php

namespace App\Traits\Filters;

use Illuminate\Database\Eloquent\Builder;

trait FilterCompanyVisibilityTrait
{
    /**
     * @param boolean $companyVisibility CompanyVisibility.
     * @return Builder
     */
    public function companyVisibility($companyVisibility): Builder // phpcs:ignore
    {
        if (is_string($companyVisibility)) {
            $companyVisibility = $companyVisibility === 'true';
        }
        if ($companyVisibility) {
            return $this->builder->whereCompanyVisibility();
        }

        return $this->builder->whereNotCompanyVisibility();
    }
}
