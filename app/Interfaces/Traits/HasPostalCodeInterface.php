<?php

namespace App\Interfaces\Traits;

use Illuminate\Database\Eloquent\Builder;

interface HasPostalCodeInterface
{
    /**
     * @param Builder $builder    Builder.
     * @param array   $postalCode PostalCode.
     * @return Builder
     */
    public function scopeWherePostalCodeIn(Builder $builder, array $postalCode): Builder;

    /**
     * @param Builder $builder    Builder.
     * @param integer $postalCode PostalCode.
     * @return Builder
     */
    public function scopeWherePostalCodeIs(Builder $builder, int $postalCode): Builder;
}
