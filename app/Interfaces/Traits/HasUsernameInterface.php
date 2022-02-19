<?php

namespace App\Interfaces\Traits;

use Illuminate\Database\Eloquent\Builder;

interface HasUsernameInterface
{
    /**
     * @param Builder $builder  Builder.
     * @param string  $username Username.
     *
     * @return Builder
     */
    public function scopeWhereUsernameLike(Builder $builder, string $username): Builder;
}
