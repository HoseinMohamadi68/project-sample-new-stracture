<?php

namespace App\Traits\Filters;

use Illuminate\Database\Eloquent\Builder;

trait FilterMobileTrait
{
    /**
     * Filter by mobile.
     *
     * @param string $mobile Mobile.
     *
     * @return Builder
     */
    protected function mobile(string $mobile): Builder
    {
        return $this->builder->whereMobile($mobile);
    }
}
