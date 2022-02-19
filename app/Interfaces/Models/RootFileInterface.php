<?php

namespace App\Interfaces\Models;

use App\Interfaces\Traits\HasContentHashInterface;
use App\Interfaces\Traits\HasMimeTypeInterface;
use App\Interfaces\Traits\HasPathInterface;
use App\Interfaces\Traits\HasSizeInterface;
use App\Interfaces\Traits\IsSyncedInterface;

interface RootFileInterface extends
    BaseModelInterface,
    HasContentHashInterface,
    HasMimeTypeInterface,
    HasSizeInterface,
    HasPathInterface,
    IsSyncedInterface
{
    /**
     * Find or create rootFile.
     *
     * @param string  $hashContent Content hash.
     * @param string  $mimeType    Mime type.
     * @param integer $size        Size.
     * @param string  $path        Path.
     *
     * @return RootFileInterface
     */
    public static function createObject(
        string $hashContent,
        string $mimeType,
        int $size,
        string $path
    ): RootFileInterface;
}
