<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasRegisterOfficeTrait
{
    /**
     * @param Builder $builder        Builder.
     * @param string  $registerOffice Register Office.
     *
     * @return Builder
     */
    public function scopeWhereRegisterOfficeLike(Builder $builder, string $registerOffice): Builder
    {
        return $builder->where(self::REGISTER_OFFICE, 'like', "%$registerOffice%");
    }
}
