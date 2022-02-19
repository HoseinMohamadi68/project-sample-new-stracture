<?php

namespace App\Http\Resources\SaleSystem;

use App\Http\Resources\User\UserResource;
use App\Models\SaleSystem\SaleSystem;
use App\Models\Translations\SaleSystemTranslation;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class SaleSystemResource
 * @package App\Http\Resources\User
 */
class SaleSystemResource extends JsonResource
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
            SaleSystem::ID => $this->getId(),
            SaleSystem::DOMAIN => $this->getDomain(),
            SaleSystem::REGISTER_NUMBER => $this->getRegisterNumber(),
            SaleSystem::REGISTER_OFFICE => $this->getRegisterOffice(),
            SaleSystem::PHONE => $this->getPhone(),
            SaleSystem::FAX => $this->getFax(),
            SaleSystemTranslation::NAME => $this->getName(),
            SaleSystemTranslation::DESCRIPTION => $this->getDescription(),
            SaleSystem::HAS_NETWORK => $this->getHasNetwork(),
            SaleSystem::HAS_BTOB => $this->getHasBtob(),
            SaleSystem::HAS_BTOC => $this->getHasBtoc(),
            SaleSystem::HAS_WAREHOUSE => $this->getHasWarehouse(),
            SaleSystem::HAS_DELIVERY => $this->getHasDelivery(),
            SaleSystem::WARRANTY_DAYS => $this->getWarrantyDays(),
            SaleSystem::MAX_CLIENT_ROOT => $this->getMaxClientRoot(),
            SaleSystem::IS_ACTIVE => $this->getIsActive(),
            SaleSystem::CREATED_AT => $this->getCreatedAt(),
            SaleSystem::UPDATED_AT => $this->getUpdatedAt(),
            'user' => $this->whenLoaded(
                'user',
                function () {
                    return UserResource::collection($this->user);
                }
            ),
        ];
    }
}
