<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasApprovedTrait
{
    /**
     * @param Builder $builder  Builder.
     * @param boolean $approved Approved.
     *
     * @return Builder
     */
    public function scopeWhereApprovedIs(Builder $builder, bool $approved): Builder
    {
        return $builder->where(self::APPROVED, $approved);
    }
}
