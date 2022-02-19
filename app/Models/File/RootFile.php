<?php

namespace App\Models\File;

use App\Interfaces\Models\RootFileInterface;
use App\Models\BaseModel;
use App\Traits\HasContentHashTrait;
use App\Traits\HasIDTrait;
use App\Traits\HasMimeTypeTrait;
use App\Traits\HasPathTrait;
use App\Traits\HasSizeTrait;
use App\Traits\IsSyncedTrait;

class RootFile extends BaseModel implements RootFileInterface
{
    use HasIDTrait;
    use HasMimeTypeTrait;
    use HasSizeTrait;
    use IsSyncedTrait;
    use HasPathTrait;
    use HasContentHashTrait;

    /** @var boolean */
    public $timestamps = false;

    const TABLE = 'root_files';
    const ID = 'id';
    const PATH = 'path';
    const CONTENT_HASH = 'content_hash';
    const MIME_TYPE = 'mime_type';
    const SIZE = 'size';
    const SYNCED = 'synced';
    const RETRY = 'retry';
    const NEXT_RETRY = 'next_retry';

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
    ): RootFileInterface {
        $rootFile = self::whereContentHashIs($hashContent)->first();

        if ($rootFile) {
            return $rootFile;
        }

        $rootFile = new self();
        $rootFile->setContentHash($hashContent);
        $rootFile->setMimeType($mimeType);
        $rootFile->setSize($size);
        $rootFile->setPath($path);
        $rootFile->sync();
        $rootFile->save();

        return $rootFile;
    }
}
