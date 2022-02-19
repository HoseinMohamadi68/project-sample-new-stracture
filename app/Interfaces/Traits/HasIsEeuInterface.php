<?php

namespace App\Interfaces\Traits;

use Illuminate\Database\Eloquent\Builder;

interface HasIsEeuInterface
{
    const IS_EEU = 'is_eeu';
    /**
     * @param Builder $builder Builder.
     *
     * @return Builder
     */
    public function scopeWhereEeu(Builder $builder): Builder;

    /**
     * @param Builder $builder Builder.
     *
     * @return Builder
     */
    public function scopeWhereNotEeu(Builder $builder): Builder;
}
