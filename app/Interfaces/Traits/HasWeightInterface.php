<?php

namespace App\Interfaces\Traits;

use Illuminate\Database\Eloquent\Builder;

interface HasWeightInterface
{
    /**
     * @param Builder $builder Builder.
     * @param integer $weight  Weight.
     *
     * @return Builder
     */
    public function scopeWhereWeightGreaterThan(Builder $builder, int $weight): Builder;

    /**
     * @param Builder $builder Builder.
     * @param integer $weight  Weight.
     *
     * @return Builder
     */
    public function scopeWhereWeightLessThan(Builder $builder, int $weight): Builder;

    /**
     * @param Builder $builder Builder.
     * @param integer $weight  Weight.
     *
     * @return Builder
     */
    public function scopeWhereWeightIs(Builder $builder, int $weight): Builder;
}
