<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasSendVatResponsibleTrait
{
    /**
     * @param Builder $builder Builder.
     *
     * @return Builder
     */
    public function scopeWhereHasSendVatResponsible(Builder $builder): Builder
    {
        return $builder->where(self::SEND_VAT_RESPONSIBLE, true);
    }

    /**
     * @param Builder $builder Builder.
     *
     * @return Builder
     */
    public function scopeWhereHasNotSendVatResponsible(Builder $builder): Builder
    {
        return $builder->where(self::SEND_VAT_RESPONSIBLE, false);
    }
}
