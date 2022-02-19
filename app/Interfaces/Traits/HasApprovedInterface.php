<?php

namespace App\Interfaces\Traits;

use Illuminate\Database\Eloquent\Builder;

interface HasApprovedInterface
{
    /**
     * @param Builder $builder  Builder.
     * @param boolean $approved Approved.
     *
     * @return Builder
     */
    public function scopeWhereApprovedIs(Builder $builder, bool $approved): Builder;
}
