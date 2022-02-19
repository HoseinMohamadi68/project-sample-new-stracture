<?php

namespace App\Interfaces\Traits;

use Illuminate\Database\Eloquent\Builder;

interface HasDefaultVatInterface
{
    const DEFAULT_VAT = 'default_vat';

    /**
     * @param Builder $builder    Builder.
     * @param float   $defaultVat Vat.
     *
     * @return Builder
     */
    public function scopeWhereDefaultVatGreaterThan(Builder $builder, float $defaultVat): Builder;

    /**
     * @param Builder $builder    Builder.
     * @param float   $defaultVat Vat.
     *
     * @return Builder
     */
    public function scopeWhereDefaultVatLessThan(Builder $builder, float $defaultVat): Builder;
}
