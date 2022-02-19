<?php

namespace App\Http\Resources\File;

use App\Models\File\RootFile;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RootFileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request Request.
     *
     * @return array
     */
    public function toArray($request): array
    {
        return [
            RootFile::ID => $this->getId(),
            RootFile::PATH => $this->getPath(),
            RootFile::SIZE => $this->getSize(),
            RootFile::MIME_TYPE => $this->getMimeType(),
        ];
    }
}
