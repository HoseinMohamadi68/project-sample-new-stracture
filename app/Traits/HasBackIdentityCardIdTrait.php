<?php

namespace App\Traits;

use App\Models\File\File;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasBackIdentityCardIdTrait
{
    /**
     * @param Builder $builder             Builder.
     * @param array   $backIdentityCardIds IDs.
     *
     * @return Builder
     */
    public function scopeWhereBackIdentityCardIdIn(Builder $builder, array $backIdentityCardIds): Builder
    {
        return $builder->whereIn(self::BACK_IDENTITY_CARD_ID, $backIdentityCardIds);
    }

    /**
     * @return BelongsTo
     */
    public function backIdentityCard(): BelongsTo
    {
        return $this->belongsTo(File::class, self::BACK_IDENTITY_CARD_ID);
    }
}
