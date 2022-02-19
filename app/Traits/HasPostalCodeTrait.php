<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasPostalCodeTrait
{
    /**
     * @param Builder $builder    Builder.
     * @param array   $postalCode PostalCode.
     * @return Builder
     */
    public function scopeWherePostalCodeIn(Builder $builder, array $postalCode): Builder
    {
        return $builder->whereIn(self::POSTAL_CODE, $postalCode);
    }

    /**
     * @param Builder $builder    Builder.
     * @param integer $postalCode PostalCode.
     * @return Builder
     */
    public function scopeWherePostalCodeIs(Builder $builder, int $postalCode): Builder
    {
        return $builder->where(self::POSTAL_CODE, $postalCode);
    }
}
