<?php

namespace App\Traits;

use App\Models\File;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasFileIdTrait
{
    /**
     * @param Builder $builder Builder.
     * @param integer $fileId  File ID.
     *
     * @return Builder
     */
    public function scopeWhereFileIdIs(Builder $builder, int $fileId): Builder
    {
        return $builder->where(self::FILE_ID, $fileId);
    }

    /**
     * @param Builder $builder Builder.
     * @param array   $fileIds City IDs.
     *
     * @return Builder
     */
    public function scopeWhereFileIdIn(Builder $builder, array $fileIds): Builder
    {
        return $builder->whereIn(self::FILE_ID, $fileIds);
    }

    /**
     * @return BelongsTo
     */
    public function file(): BelongsTo
    {
        return $this->belongsTo(File::class);
    }
}
