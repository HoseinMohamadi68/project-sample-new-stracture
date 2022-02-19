<?php

namespace App\Traits\Filters;

use Illuminate\Database\Eloquent\Builder;

trait FilterOwnerIdTrait
{
    /**
    * Filter by Owner Id .
    *
    * @param integer $ownerId Owner Id .
    *
    * @return Builder
    */
    protected function ownerId(int $ownerId): Builder
    {
        return $this->builder->whereOwnerIdIs($ownerId);
    }

    /**
     * Filter by Owner Ids.
     *
     * @param array $ownerIdIn Owner Ids.
     *
     * @return Builder
     */
    protected function ownerIdIn(array $ownerIdIn): Builder
    {
        return $this->builder->whereOwnerIdIn($ownerIdIn);
    }
}
