<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasPhoneTrait
{
    /**
     * @param Builder $builder Builder.
     * @param string  $phone   Phone.
     *
     * @return Builder
     */
    public function scopeWherePhoneLike(Builder $builder, string $phone): Builder
    {
        return $builder->where(self::PHONE, 'like', "%$phone%");
    }
}
