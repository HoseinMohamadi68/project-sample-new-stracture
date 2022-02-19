<?php

namespace App\Interfaces\Traits;

use Illuminate\Database\Eloquent\Builder;

interface HasRegisterNumberInterface
{
    /**
     * @param Builder $builder        Builder.
     * @param string  $registerNumber Register Number.
     *
     * @return Builder
     */
    public function scopeWhereRegisterNumberLike(Builder $builder, string $registerNumber): Builder;
}
