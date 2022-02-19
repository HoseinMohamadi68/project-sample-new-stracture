<?php

namespace App\Interfaces\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

interface HasBackIdentityCardIdInterface
{
    /**
     * @param Builder $builder             Builder.
     * @param array   $backIdentityCardIds IDs.
     *
     * @return Builder
     */
    public function scopeWhereBackIdentityCardIdIn(Builder $builder, array $backIdentityCardIds): Builder;

    /**
     * @return BelongsTo
     */
    public function backIdentityCard(): BelongsTo;
}
