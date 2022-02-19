<?php

namespace App\Traits\Filters;

use Illuminate\Database\Eloquent\Builder;

trait FilterUsernameTrait
{
    /**
     * @param string $username Username.
     * @return Builder
     */
    protected function username(string $username): Builder
    {
        return $this->builder->whereUsernameLike($username);
    }
}
