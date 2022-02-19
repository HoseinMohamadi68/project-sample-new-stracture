<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasMaxClientRootTrait
{
    /**
     * @param Builder $builder       Builder.
     * @param integer $maxClientRoot Max Client Root.
     *
     * @return Builder
     */
    public function scopeWhereMaxClientRootGreaterThan(Builder $builder, int $maxClientRoot): Builder
    {
        return $builder->where(self::MAX_CLIENT_ROOT, '>=', $maxClientRoot);
    }

    /**
     * @param Builder $builder       Builder.
     * @param integer $maxClientRoot Max Client Root.
     *
     * @return Builder
     */
    public function scopeWhereMaxClientRootLessThan(Builder $builder, int $maxClientRoot): Builder
    {
        return $builder->where(self::MAX_CLIENT_ROOT, '<=', $maxClientRoot);
    }
}
