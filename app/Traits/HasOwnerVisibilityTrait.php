<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasOwnerVisibilityTrait
{
    /**
     * @param Builder $builder Builder.
     *
     * @return Builder
     */
    public function scopeWhereOwnerVisibility(Builder $builder): Builder
    {
        return $builder->where(self::OWNER_VISIBILITY, true);
    }

    /**
     * @param Builder $builder Builder.
     *
     * @return Builder
     */
    public function scopeWhereNotOwnerVisibility(Builder $builder): Builder
    {
        return $builder->where(self::OWNER_VISIBILITY, false);
    }
}
