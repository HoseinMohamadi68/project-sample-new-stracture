<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasDomainTrait
{
    /**
     * @param Builder $builder Builder.
     * @param string  $domain  Domain.
     *
     * @return Builder
     */
    public function scopeWhereDomainLike(Builder $builder, string $domain): Builder
    {
        return $builder->where(self::DOMAIN, 'like', "%$domain%");
    }
}
