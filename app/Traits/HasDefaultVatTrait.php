<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasDefaultVatTrait
{

    /**
     *
     * @param Builder $builder    Builder.
     * @param float   $defaultVat Vat.
     *
     * @return Builder
     */
    public function scopeWhereDefaultVatIs(Builder $builder, float $defaultVat): Builder
    {
        return $builder->where(self::DEFAULT_VAT, '=', $defaultVat);
    }


    /**
     * @param Builder $builder    Builder.
     * @param float   $defaultVat Vat.
     *
     * @return Builder
     */
    public function scopeWhereDefaultVatGreaterThan(Builder $builder, float $defaultVat): Builder
    {
        return $builder->where(self::DEFAULT_VAT, '>=', $defaultVat);
    }

    /**
     * @param Builder $builder    Builder.
     * @param float   $defaultVat Vat.
     *
     * @return Builder
     */
    public function scopeWhereDefaultVatLessThan(Builder $builder, float $defaultVat): Builder
    {
        return $builder->where(self::DEFAULT_VAT, '<=', $defaultVat);
    }
}
