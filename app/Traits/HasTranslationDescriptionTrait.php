<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasTranslationDescriptionTrait
{
    /**
     * @param Builder $builder     Builder.
     * @param string  $description Description.
     * @return Builder
     */
    public function scopeWhereDescriptionLike(Builder $builder, string $description): Builder
    {
        return $builder->whereHas(
            'translations',
            function (Builder $joinTranslation) use ($description) {
                return $joinTranslation->whereDescriptionLike($description);
            }
        );
    }

    /**
     * @param Builder $builder     Builder.
     * @param string  $description Description.
     * @return Builder
     */
    public function scopeOrWhereDescriptionLike(Builder $builder, string $description): Builder
    {
        return $builder->orWhereHas(
            'translations',
            function (Builder $joinTranslation) use ($description) {
                return $joinTranslation->orWhereDescriptionLike($description);
            }
        );
    }
}
