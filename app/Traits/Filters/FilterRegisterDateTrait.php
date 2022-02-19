<?php

namespace App\Traits\Filters;

use Illuminate\Database\Eloquent\Builder;

trait FilterRegisterDateTrait
{
    /**
     * Filter by registerDate.
     *
     * @param string $registerDate Register Date.
     *
     * @return Builder
     */
    protected function registerDate(string $registerDate): Builder
    {
        return $this->builder->whereRegisterDateIs($registerDate);
    }

    /**
     * Filter by GreaterThan registerDate.
     *
     * @param string $registerDate Register Date.
     *
     * @return Builder
     */
    protected function registerDateGreaterThan(string $registerDate): Builder
    {
        return $this->builder->whereRegisterDateGreaterThan($registerDate);
    }

    /**
     * Filter by LessThan registerDate.
     *
     * @param string $registerDate Register Date.
     *
     * @return Builder
     */
    protected function registerDateLessThan(string $registerDate): Builder
    {
        return $this->builder->whereRegisterDateLessThan($registerDate);
    }
}
