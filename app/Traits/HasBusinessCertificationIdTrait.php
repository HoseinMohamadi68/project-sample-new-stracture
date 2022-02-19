<?php

namespace App\Traits;

use App\Models\File\File;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasBusinessCertificationIdTrait
{
    /**
     * @param Builder $builder                 Builder.
     * @param array   $businessCertificationId IDs.
     *
     * @return Builder
     */
    public function scopeWhereBusinessCertificationIdIn(Builder $builder, array $businessCertificationId): Builder
    {
        return $builder->whereIn(self::BUSINESS_CERTIFICATION_ID, $businessCertificationId);
    }

    /**
     * @return BelongsTo
     */
    public function businessCertification(): BelongsTo
    {
        return $this->belongsTo(File::class, self::BUSINESS_CERTIFICATION_ID);
    }
}
