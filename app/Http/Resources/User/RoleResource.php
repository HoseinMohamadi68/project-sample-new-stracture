<?php

namespace App\Http\Resources\User;

use App\Constants\PermissionTitle;
use App\Models\LocalizableModel;
use App\Models\Translations\RoleTranslation;
use App\Models\User\Role;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class RoleResource
 *
 * @package App\Http\Resources
 */
class RoleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request Request.
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            Role::ID => $this->getId(),
            RoleTranslation::TITLE => $this->getTitle(),
            Role::COMPANY_VISIBILITY => $this->getCompanyVisibility(),
            Role::OWNER_VISIBILITY => $this->getOwnerVisibility(),
            'permissions' => $this->whenLoaded(
                'permissions',
                function () {
                    return PermissionResource::collection($this->permissions);
                }
            ),
            LocalizableModel::LOCALIZATION_KEY => $this->when(
                $request->user()->hasPermission(PermissionTitle::ALL_LANGUAGES),
                $this->translations
            )
        ];
    }
}
