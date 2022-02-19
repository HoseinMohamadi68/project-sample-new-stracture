<?php

namespace App\Interfaces\Traits;

use Illuminate\Database\Eloquent\Builder;

interface HasEmailInterface
{
    const EMAIL = 'email';

    /**
     * @param Builder $builder Builder.
     * @param string  $email   Email.
     *
     * @return Builder
     */
    public function scopeWhereEmailLike(Builder $builder, string $email): Builder;
}
