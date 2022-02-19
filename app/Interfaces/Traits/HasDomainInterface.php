<?php

namespace App\Interfaces\Traits;

use Illuminate\Database\Eloquent\Builder;

interface HasDomainInterface
{
    /**
     * @param Builder $builder Builder.
     * @param string  $domain  Domain.
     *
     * @return Builder
     */
    public function scopeWhereDomainLike(Builder $builder, string $domain): Builder;
}
