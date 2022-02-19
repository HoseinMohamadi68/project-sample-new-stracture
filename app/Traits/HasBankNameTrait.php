<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasBankNameTrait
{
    /**
     * @param Builder $builder  Builder.
     * @param string  $bankName Bank Name.
     *
     * @return Builder
     */
    public function scopeWhereBankNameLike(Builder $builder, string $bankName): Builder
    {
        return $builder->where(self::BANK_NAME, 'like', "%$bankName%");
    }
}
