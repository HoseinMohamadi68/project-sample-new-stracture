<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

trait HasFirstNameTrait
{
    /**
     * @param Builder $builder   Builder.
     * @param string  $firstName FirstName.
     *
     * @return Builder
     */
    public function scopeWhereFirstNameLike(Builder $builder, string $firstName): Builder
    {
        return $builder->where(User::FIRST_NAME, 'like', "%$firstName%");
    }

    /**
     * @param Builder $builder   Builder.
     * @param string  $firstName FirstName.
     *
     * @return Builder
     */
    public function scopeOrWhereFirstNameLike(Builder $builder, string $firstName): Builder
    {
        return $builder->orWhere(User::FIRST_NAME, 'like', "%$firstName%");
    }
}
