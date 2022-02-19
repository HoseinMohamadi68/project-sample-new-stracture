<?php

namespace App\Interfaces\Traits;

use Illuminate\Database\Eloquent\Builder;

interface IsEnableInterface
{
    /**
     * Is enable.
     *
     * @return boolean
     */
    public function isEnable(): bool;

    /**
     * @param Builder $builder Builder.
     *
     * @return Builder
     */
    public function scopeWhereEnabled(Builder $builder): Builder;

    /**
     * @param Builder $builder Builder.
     *
     * @return Builder
     */
    public function scopeWhereNotEnabled(Builder $builder): Builder;
}
