<?php

namespace App\Interfaces\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

interface HasParentIdInterface
{
    /**
     * @param Builder $builder  Builder.
     * @param integer $parentId Parent ID.
     *
     * @return Builder
     */
    public function scopeWhereParentIdIs(Builder $builder, int $parentId): Builder;

    /**
     * @param Builder $builder   Builder.
     * @param array   $parentIds Parent IDs.
     *
     * @return Builder
     */
    public function scopeWhereParentIdIn(Builder $builder, array $parentIds): Builder;

    /**
     * @return BelongsTo
     */
    public function parent(): BelongsTo;
}
