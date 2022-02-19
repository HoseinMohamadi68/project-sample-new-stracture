<?php

namespace App\Interfaces\Traits;

use Illuminate\Database\Eloquent\Builder;

interface HasStartedAtInterface
{
    /**
     * @param Builder $builder Builder.
     * @param string  $date    Started At Date.
     *
     * @return Builder
     */
    public function scopeWhereStartedAtIs(Builder $builder, string $date): Builder;

    /**
     * @param Builder $builder Builder.
     * @param string  $date    Started At Date.
     *
     * @return Builder
     */
    public function scopeWhereStartedAtGreaterThan(Builder $builder, string $date): Builder;

    /**
     * @param Builder $builder Builder.
     * @param string  $date    Started At Date.
     *
     * @return Builder
     */
    public function scopeWhereStartedAtLessThan(Builder $builder, string $date): Builder;
}
