<?php

namespace App\Interfaces\Traits;

use Illuminate\Database\Eloquent\Builder;

interface HasIbanInterface
{
    /**
     * @param Builder $builder Builder.
     * @param string  $iban    Iban.
     *
     * @return Builder
     */
    public function scopeWhereIbanLike(Builder $builder, string $iban): Builder;
}
