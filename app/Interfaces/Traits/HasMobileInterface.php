<?php

namespace App\Interfaces\Traits;

use Illuminate\Database\Eloquent\Builder;

interface HasMobileInterface
{
    /**
     * @param Builder $builder Builder.
     * @param string  $mobile  Mobile.
     *
     * @return Builder
     */
    public function scopeWhereMobileLike(Builder $builder, string $mobile): Builder;
}
