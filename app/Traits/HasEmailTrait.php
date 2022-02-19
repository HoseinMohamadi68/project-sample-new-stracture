<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasEmailTrait
{
    /**
     * @param Builder $builder Builder.
     * @param string  $email   Email.
     *
     * @return Builder
     */
    public function scopeWhereEmailLike(Builder $builder, string $email): Builder
    {
        return $builder->where(self::EMAIL, 'like', "%$email%");
    }
}
