<?php

namespace App\Interfaces\Traits;

use Illuminate\Database\Eloquent\Builder;

interface HasStatusInterface
{
    /**
     * @param Builder $builder Builder.
     * @param string  $status  Status.
     *
     * @return Builder
     */
    public function scopeWhereStatusIs(Builder $builder, string $status): Builder;

    /**
     * @param Builder $builder  Builder.
     * @param array   $statuses Statuses.
     *
     * @return Builder
     */
    public function scopeWhereStatusIn(Builder $builder, array $statuses): Builder;

    /**
     * @param Builder $builder  Builder.
     * @param array   $statuses Statuses.
     *
     * @return Builder
     */
    public function scopeWhereStatusNotIn(Builder $builder, array $statuses): Builder;
}
