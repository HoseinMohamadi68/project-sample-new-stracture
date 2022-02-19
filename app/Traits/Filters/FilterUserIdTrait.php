<?php

namespace App\Traits\Filters;

use Illuminate\Database\Eloquent\Builder;

trait FilterUserIdTrait
{
    /**
     * Filter by User Id.
     *
     * @param integer $userId User Id.
     *
     * @return Builder
     */
    protected function userId(int $userId): Builder
    {
        return $this->builder->whereUserId($userId);
    }

    /**
     * Filter by User Ids.
     *
     * @param array $userIds User Ids.
     *
     * @return Builder
     */
    protected function userIds(array $userIds): Builder
    {
        return $this->builder->whereUserIdIn($userIds);
    }
}
