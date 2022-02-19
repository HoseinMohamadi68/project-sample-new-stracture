<?php

namespace App\Interfaces\Traits;

use Illuminate\Database\Eloquent\Builder;

interface HasCreatedAtInterface
{
    /**
     * @param Builder $builder   Builder.
     * @param string  $createdAt Date and time stamps.
     *
     * @return Builder
     */
    public function scopeWhereCreatedAtIs(Builder $builder, string $createdAt): Builder;

    /**
     * @param Builder $builder   Builder.
     * @param string  $createdAt Date and time stamps.
     *
     * @return Builder
     */
    public function scopeWhereCreatedAtGreaterThan(Builder $builder, string $createdAt): Builder;

    /**
     * @param Builder $builder   Builder.
     * @param string  $createdAt Date and time stamps.
     *
     * @return Builder
     */
    public function scopeWhereCreatedAtLessThan(Builder $builder, string $createdAt): Builder;
}
