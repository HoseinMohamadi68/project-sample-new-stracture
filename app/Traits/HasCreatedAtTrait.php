<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasCreatedAtTrait
{
    /**
     * @param Builder $builder   Builder.
     * @param string  $createdAt Date and time stamps.
     *
     * @return Builder
     */
    public function scopeWhereCreatedAtIs(Builder $builder, string $createdAt): Builder
    {
        return $builder->where(self::CREATED_AT, $createdAt);
    }

    /**
     * @param Builder $builder   Builder.
     * @param string  $createdAt Date and time stamps.
     *
     * @return Builder
     */
    public function scopeWhereCreatedAtGreaterThan(Builder $builder, string $createdAt): Builder
    {
        return $builder->where(self::CREATED_AT, '>=', $createdAt);
    }

    /**
     * @param Builder $builder   Builder.
     * @param string  $createdAt Date and time stamps.
     *
     * @return Builder
     */
    public function scopeWhereCreatedAtLessThan(Builder $builder, string $createdAt): Builder
    {
        return $builder->where(self::CREATED_AT, '<=', $createdAt);
    }
}
