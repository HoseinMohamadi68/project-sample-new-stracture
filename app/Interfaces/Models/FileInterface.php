<?php

namespace App\Interfaces\Models;

use App\Filters\FileFilter;
use App\Interfaces\Traits\BelongsToRootFileInterface;
use App\Interfaces\Traits\HasExtensionInterface;
use App\Interfaces\Traits\HasNameInterface;
use App\Interfaces\Traits\IsEnableInterface;
use Illuminate\Http\UploadedFile;
use Illuminate\Database\Eloquent\Builder;

interface FileInterface extends
    BaseModelInterface,
    HasNameInterface,
    HasExtensionInterface,
    IsEnableInterface,
    BelongsToRootFileInterface
{
    /**
     * Filter scope.
     *
     * @param Builder    $builder Builder.
     * @param FileFilter $filters Filters.
     *
     * @return Builder
     */
    public function scopeFilter(Builder $builder, FileFilter $filters): Builder;

    /**
     * Create file
     *
     * @param UploadedFile $file File.
     *
     * @return FileInterface
     *
     * @throws \Exception Exception.
     */
    public static function createObject(UploadedFile $file): FileInterface;
}
