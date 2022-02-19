<?php

namespace App\Traits\Filters;

use Illuminate\Database\Eloquent\Builder;

trait FilterOwnerVisibilityTrait
{
    /**
     * @param boolean $ownerVisibility CompanyVisibility.
     * @return Builder
     */
    public function ownerVisibility($ownerVisibility): Builder // phpcs:ignore
    {
        if (is_string($ownerVisibility)) {
            $ownerVisibility = $ownerVisibility === 'true';
        }
        if ($ownerVisibility) {
            return $this->builder->whereOwnerVisibility();
        }

        return $this->builder->whereNotOwnerVisibility();
    }
}
