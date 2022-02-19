<?php

namespace App\Interfaces\Traits;

use Illuminate\Database\Eloquent\Builder;

interface HasBankNameInterface
{
    /**
     * @param Builder $builder  Builder.
     * @param string  $bankName Bank Name.
     *
     * @return Builder
     */
    public function scopeWhereBankNameLike(Builder $builder, string $bankName): Builder;
}
