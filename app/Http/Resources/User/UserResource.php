<?php

namespace App\Http\Resources\User;

use App\Constants\PermissionTitle;
use App\Models\User\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

/**
 * Class UserResource
 *
 * @package App\Http\Resources
 */
class UserResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param Request $request BaseRequest.
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            User::ID => $this->getId(),
            User::APPROVED => $this->getApproved(),
            User::FIRST_NAME => $this->getFirstName(),
            User::LAST_NAME => $this->getLastName(),
            User::MOBILE => $this->getMobile(),
            User::EMAIL => $this->getEmail(),
            User::CHARGE => $this->getCharge(),
            User::PHONE => $this->getPhone(),
            User::CREATED_AT => $this->getCreatedAt(),
            User::UPDATED_AT => $this->getUpdatedAt(),
            'roles' => $this->when(
                optional($request->user())->hasPermission(PermissionTitle::CREATE_USER) ||
                        optional($request->user())->hasPermission(PermissionTitle::UPDATE_USER),
                        function () {
                            return RoleResource::collection($this->roles);
                        }
            ),
        ];
    }
}
