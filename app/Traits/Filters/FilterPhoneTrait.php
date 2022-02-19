<?php

namespace App\Traits\Filters;

use Illuminate\Database\Eloquent\Builder;

trait FilterPhoneTrait
{
    /**
     * @param string $phone Phone.
     *
     * @return Builder
     */
    protected function phone(string $phone): Builder
    {
        return $this->builder->wherePhoneLike($phone);
    }
}
