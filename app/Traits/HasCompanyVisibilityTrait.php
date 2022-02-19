<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasCompanyVisibilityTrait
{
    /**
     * @param Builder $builder Builder.
     *
     * @return Builder
     */
    public function scopeWhereCompanyVisibility(Builder $builder): Builder
    {
        return $builder->where(self::COMPANY_VISIBILITY, true);
    }

    /**
     * @param Builder $builder Builder.
     *
     * @return Builder
     */
    public function scopeWhereNotCompanyVisibility(Builder $builder): Builder
    {
        return $builder->where(self::COMPANY_VISIBILITY, false);
    }
}
