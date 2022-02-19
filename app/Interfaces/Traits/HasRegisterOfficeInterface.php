<?php

namespace App\Interfaces\Traits;

use Illuminate\Database\Eloquent\Builder;

interface HasRegisterOfficeInterface
{
    /**
     * @param Builder $builder        Builder.
     * @param string  $registerOffice Title.
     *
     * @return Builder
     */
    public function scopeWhereRegisterOfficeLike(Builder $builder, string $registerOffice): Builder;
}
