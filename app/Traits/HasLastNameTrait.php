<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

trait HasLastNameTrait
{
    /**
     * @param Builder $builder  Builder.
     * @param string  $lastName LastName.
     *
     * @return Builder
     */
    public function scopeWhereLastNameLike(Builder $builder, string $lastName): Builder
    {
        return $builder->where(User::LAST_NAME, 'like', "%$lastName%");
    }

    /**
     * @param Builder $builder  Builder.
     * @param string  $lastName LastName.
     *
     * @return Builder
     */
    public function scopeOrWhereLastNameLike(Builder $builder, string $lastName): Builder
    {
        return $builder->orWhere(User::LAST_NAME, 'like', "%$lastName%");
    }
}
