<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasParentIdTrait
{
    /**
     * @param Builder $builder  Builder.
     * @param integer $parentId ID.
     *
     * @return Builder
     */
    public function scopeWhereParentIdIs(Builder $builder, int $parentId): Builder
    {
        return $builder->where(self::PARENT_ID, $parentId);
    }

    /**
     * @param Builder $builder   Builder.
     * @param array   $parentIds IDs.
     *
     * @return Builder
     */
    public function scopeWhereParentIdIn(Builder $builder, array $parentIds): Builder
    {
        return $builder->whereIn(self::PARENT_ID, $parentIds);
    }

    /**
     * @return BelongsTo
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class);
    }
}
