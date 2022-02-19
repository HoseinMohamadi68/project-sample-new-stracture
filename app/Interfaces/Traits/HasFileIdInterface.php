<?php

namespace App\Interfaces\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

interface HasFileIdInterface
{
    /**
     * @param Builder $builder Builder.
     * @param integer $fileId  File ID.
     *
     * @return Builder
     */
    public function scopeWhereFileIdIs(Builder $builder, int $fileId): Builder;

    /**
     * @param Builder $builder Builder.
     * @param array   $fileIds City IDs.
     *
     * @return Builder
     */
    public function scopeWhereFileIdIn(Builder $builder, array $fileIds): Builder;

    /**
     * @return BelongsTo
    */
    public function file(): BelongsTo;
}
