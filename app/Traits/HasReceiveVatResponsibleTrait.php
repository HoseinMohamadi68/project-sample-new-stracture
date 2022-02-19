<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasReceiveVatResponsibleTrait
{
    /**
     * @param Builder $builder Builder.
     *
     * @return Builder
     */
    public function scopeWhereHasReceiveVatResponsible(Builder $builder): Builder
    {
        return $builder->where(self::RECEIVE_VAT_RESPONSIBLE, true);
    }

    /**
     * @param Builder $builder Builder.
     *
     * @return Builder
     */
    public function scopeWhereHasNotReceiveVatResponsible(Builder $builder): Builder
    {
        return $builder->where(self::RECEIVE_VAT_RESPONSIBLE, false);
    }
}
