<?php

namespace App\Http\Resources\File;

use App\Models\File\File;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FileResource extends JsonResource
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
            File::ID => $this->getId(),
            File::EXTENSION => $this->getExtension(),
            File::ENABLED => $this->isEnable(),
            File::NAME => $this->getName(),
            'root_file' => new RootFileResource($this->rootFile),
            File::CREATED_AT => $this->{File::CREATED_AT},
            File::UPDATED_AT => $this->{File::UPDATED_AT},
        ];
    }
}
