<?php

namespace App\Traits;

use App\Models\File\File;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasFrontIdentityCardIdTrait
{
    /**
     * @param Builder $builder              Builder.
     * @param array   $frontIdentityCardIds IDs.
     *
     * @return Builder
     */
    public function scopeWhereFrontIdentityCardIdIn(Builder $builder, array $frontIdentityCardIds): Builder
    {
        return $builder->whereIn(self::FRONT_IDENTITY_CARD_ID, $frontIdentityCardIds);
    }

    /**
     * @return BelongsTo
     */
    public function frontIdentityCard(): BelongsTo
    {
        return $this->belongsTo(File::class, self::FRONT_IDENTITY_CARD_ID);
    }
}
