<?php

namespace App\Http\Resources\User;

use App\Models\User\Permission;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class PermissionResource
 *
 * @package App\Http\Resources
 */
class PermissionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            Permission::ID => $this->getId(),
            Permission::TITLE => $this->getTitle(),
        ];
    }
}
