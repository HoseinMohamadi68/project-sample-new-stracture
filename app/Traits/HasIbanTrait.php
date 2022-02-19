<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasIbanTrait
{
    /**
     * @param Builder $builder Builder.
     * @param string  $iban    Iban.
     *
     * @return Builder
     */
    public function scopeWhereIbanLike(Builder $builder, string $iban): Builder
    {
        return $builder->where(self::IBAN, 'like', "%$iban%");
    }
}
