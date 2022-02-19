<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasNameTrait
{
    /**
     * @param Builder $builder Builder.
     * @param string  $name    Name.
     *
     * @return Builder
     */
    public function scopeWhereNameLike(Builder $builder, string $name): Builder
    {
        return $builder->where(self::NAME, 'like', "%$name%");
    }
}
