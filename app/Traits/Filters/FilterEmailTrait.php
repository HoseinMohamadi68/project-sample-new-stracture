<?php

namespace App\Traits\Filters;

use Illuminate\Database\Eloquent\Builder;

trait FilterEmailTrait
{
    /**
     * @param string $email Email.
     * @return Builder
     */
    protected function email(string $email): Builder
    {
        return $this->builder->whereEmailLike($email);
    }
}
