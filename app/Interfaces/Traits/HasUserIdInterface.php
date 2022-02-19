<?php

namespace App\Interfaces\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

interface HasUserIdInterface
{
    /**
     * @param Builder $builder Builder.
     * @param integer $userId  User ID.
     *
     * @return Builder
     */
    public function scopeWhereUserIdIs(Builder $builder, int $userId): Builder;

    /**
     * @param Builder $builder Builder.
     * @param integer $userId  ID.
     *
     * @return Builder
     */
    public function scopeOrWhereUserIdIs(Builder $builder, int $userId): Builder;

    /**
     * @param Builder $builder Builder.
     * @param array   $userIds User IDs.
     *
     * @return Builder
     */
    public function scopeWhereUserIdIn(Builder $builder, array $userIds): Builder;

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo;
}
