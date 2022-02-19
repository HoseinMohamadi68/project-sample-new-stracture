<?php

namespace App\Interfaces\Traits;

use Illuminate\Database\Eloquent\Builder;

interface HasTranslationDescriptionInterface
{
    /**
     * @param Builder $builder     Builder.
     * @param string  $description Description.
     * @return Builder
     */
    public function scopeWhereDescriptionLike(Builder $builder, string $description): Builder;

    /**
     * @param Builder $builder     Builder.
     * @param string  $description Description.
     * @return Builder
     */
    public function scopeOrWhereDescriptionLike(Builder $builder, string $description): Builder;
}
