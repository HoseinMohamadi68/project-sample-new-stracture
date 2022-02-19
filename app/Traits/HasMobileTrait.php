<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasMobileTrait
{
    /**
     * @param Builder $builder Builder.
     * @param string  $mobile  Mobile.
     *
     * @return Builder
     */
    public function scopeWhereMobileLike(Builder $builder, string $mobile): Builder
    {
        return $builder->where(self::MOBILE, 'like', "%$mobile%");
    }
}
