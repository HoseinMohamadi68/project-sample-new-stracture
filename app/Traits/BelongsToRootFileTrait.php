<?php

namespace App\Traits;

use App\Models\File\RootFile;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait BelongsToRootFileTrait
{
    /**
     * @return BelongsTo
     */
    public function rootFile(): BelongsTo
    {
        return $this->belongsTo(RootFile::class);
    }

    /**
     * @param Builder $builder Builder.
     * @param array   $ids     IDs.
     *
     * @return Builder
     */
    public function scopeWhereRootFileIdIn(Builder $builder, array $ids): Builder
    {
        return $builder->whereIn(self::ROOT_FILE_ID, $ids);
    }
}
