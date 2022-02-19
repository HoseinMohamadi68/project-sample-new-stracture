<?php

namespace App\Interfaces\Traits;

use Illuminate\Database\Eloquent\Builder;

interface HasIsActiveInterface
{
    /**
     * @param Builder $builder Builder.
     *
     * @return Builder
     */
    public function scopeWhereActive(Builder $builder): Builder;

    /**
     * @param Builder $builder Builder.
     *
     * @return Builder
     */
    public function scopeWhereNotActive(Builder $builder): Builder;

    /**
     * @return HasIsActiveInterface
     */
    public function active(): HasIsActiveInterface;

    /**
     * @return HasIsActiveInterface
     */
    public function deActive(): HasIsActiveInterface;
}
