<?php

namespace App\Interfaces\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

interface BelongsToRootFileInterface
{
    /**
     * @return BelongsTo
     */
    public function rootFile(): BelongsTo;

    /**
     * @param Builder $builder Builder.
     * @param array   $ids     IDs.
     *
     * @return Builder
     */
    public function scopeWhereRootFileIdIn(Builder $builder, array $ids): Builder;
}
