<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasDescriptionTrait
{
    /**
     * @param Builder $builder     Builder.
     * @param string  $description Description.
     * @return Builder
     */
    public function scopeWhereDescriptionLike(Builder $builder, string $description): Builder
    {
        return $builder->where(self::DESCRIPTION, 'like', "%$description%");
    }

    /**
     * @param Builder $builder     Builder.
     * @param string  $description Description.
     * @return Builder
     */
    public function scopeOrWhereDescriptionLike(Builder $builder, string $description): Builder
    {
        return $builder->orWhere(self::DESCRIPTION, 'like', "%$description%");
    }
}
