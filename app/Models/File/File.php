<?php

namespace App\Models\File;

use App\Filters\FileFilter;
use App\Interfaces\Models\FileInterface;
use App\Models\BaseModel;
use App\Traits\BelongsToRootFileTrait;
use App\Traits\HasExtensionTrait;
use App\Traits\HasNameTrait;
use App\Traits\IsEnableTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class File extends BaseModel implements FileInterface
{
    use HasNameTrait;
    use HasExtensionTrait;
    use IsEnableTrait;
    use BelongsToRootFileTrait;

    const TABLE = 'files';
    const ID = 'id';
    const ROOT_FILE_ID = 'root_file_id';
    const EXTENSION = 'extension';
    const ENABLED = 'enabled';

    /**
     * @var array
     */
    protected $casts = [
        self::ENABLED => 'boolean',
    ];

    /**
     * Filter scope.
     *
     * @param Builder    $builder Builder.
     * @param FileFilter $filters Filters.
     *
     * @return Builder
     */
    public function scopeFilter(Builder $builder, FileFilter $filters): Builder
    {
        return $filters->apply($builder);
    }

    /**
     * Create file
     *
     * @param UploadedFile $file File.
     *
     * @return FileInterface
     *
     * @throws \Exception Exception.
     */
    public static function createObject(UploadedFile $file): FileInterface
    {
        $hashFile = sha1_file($file);
        $extension = $file->getClientOriginalExtension();
        $fileName = $hashFile . '.' . $extension;
        $path = $fileName;
        $move = Storage::disk('public')->put($path, file_get_contents($file));
        if (!$move) {
            throw new \Exception('System Can Not Save The File!');
        }
        $rootFile = RootFile::createObject(
            $hashFile,
            $file->getClientMimeType(),
            $file->getSize(),
            Storage::url($fileName)
        );

        $dbFile = new self();
        $dbFile->setExtension($extension);
        $dbFile->setRootFileId($rootFile->getId());
        $dbFile->setName($file->getClientOriginalName());
        $dbFile->setEnabled($rootFile->isSynced());
        $dbFile->save();

        return $dbFile;
    }
}
