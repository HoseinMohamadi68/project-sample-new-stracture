<?php

namespace App\Interfaces\Traits;

use App\Models\File\File;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

interface HasFrontIdentityCardIdInterface
{
    /**
     * @param Builder $builder              Builder.
     * @param array   $frontIdentityCardIds IDs.
     *
     * @return Builder
     */
    public function scopeWhereFrontIdentityCardIdIn(Builder $builder, array $frontIdentityCardIds): Builder;

    /**
     * @return BelongsTo
     */
    public function frontIdentityCard(): BelongsTo;
}
