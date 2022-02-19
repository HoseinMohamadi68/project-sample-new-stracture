<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasRegisterNumberTrait
{
    /**
     * @param Builder $builder        Builder.
     * @param string  $registerNumber Register Number.
     *
     * @return Builder
     */
    public function scopeWhereRegisterNumberLike(Builder $builder, string $registerNumber): Builder
    {
        return $builder->where(self::REGISTER_NUMBER, 'like', "%$registerNumber%");
    }
}
