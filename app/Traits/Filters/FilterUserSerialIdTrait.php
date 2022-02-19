<?php

namespace App\Traits\Filters;

use Illuminate\Database\Eloquent\Builder;

trait FilterUserSerialIdTrait
{
    /**
     * Filter by UserSerial Id.
     *
     * @param integer $userSerialId UserSerial Id.
     *
     * @return Builder
     */
    protected function userSerialId(int $userSerialId): Builder
    {
        return $this->builder->whereUserSerialIdIs($userSerialId);
    }

    /**
     * Filter by UserSerial Ids.
     *
     * @param array $userSerialIds UserSerial Ids.
     *
     * @return Builder
     */
    protected function userSerialIds(array $userSerialIds): Builder
    {
        return $this->builder->whereUserSerialIdIn($userSerialIds);
    }
}
