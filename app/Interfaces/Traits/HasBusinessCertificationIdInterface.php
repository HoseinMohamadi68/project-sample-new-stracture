<?php

namespace App\Interfaces\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

interface HasBusinessCertificationIdInterface
{
    /**
     * @param Builder $builder                 Builder.
     * @param array   $businessCertificationId IDs.
     *
     * @return Builder
     */
    public function scopeWhereBusinessCertificationIdIn(Builder $builder, array $businessCertificationId): Builder;

    /**
     * @return BelongsTo
     */
    public function businessCertification(): BelongsTo;
}
