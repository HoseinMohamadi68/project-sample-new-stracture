<?php

namespace App\Interfaces\Traits;

use Carbon\Traits\Date;
use Illuminate\Database\Eloquent\Builder;

interface HasEndAtInterface
{
    /**
     * @param Builder $builder Builder.
     * @param string  $date    Started At Date.
     *
     * @return Builder
     */
    public function scopeWhereEndAtIs(Builder $builder, string $date): Builder;

    /**
     * @param Builder $builder Builder.
     * @param string  $date    Started At Date.
     *
     * @return Builder
     */
    public function scopeWhereEndAtGreaterThan(Builder $builder, string $date): Builder;

    /**
     * @param Builder $builder Builder.
     * @param string  $date    Started At Date.
     *
     * @return Builder
     */
    public function scopeWhereEndAtLessThan(Builder $builder, string $date): Builder;
}
