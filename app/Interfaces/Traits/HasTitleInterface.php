<?php

namespace App\Interfaces\Traits;

use Illuminate\Database\Eloquent\Builder;

interface HasTitleInterface
{
    const TITLE = 'title';

    /**
     * @param Builder $builder Builder.
     * @param string  $title   Title.
     *
     * @return Builder
     */
    public function scopeWhereTitleLike(Builder $builder, string $title): Builder;

    /**
     * @param Builder $builder Builder.
     * @param string  $title   Title.
     *
     * @return Builder
     */
    public function scopeWhereTitleIs(Builder $builder, string $title): Builder;
}
