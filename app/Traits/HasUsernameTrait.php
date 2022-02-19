<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasUsernameTrait
{
    /**
     * @param Builder $builder  Builder.
     * @param string  $username Username.
     *
     * @return Builder
     */
    public function scopeWhereUsernameLike(Builder $builder, string $username): Builder
    {
        return $builder->where(self::USERNAME, 'like', "%$username%");
    }
}
