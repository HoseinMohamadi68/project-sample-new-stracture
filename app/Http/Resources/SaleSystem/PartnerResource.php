<?php

namespace App\Http\Resources\SaleSystem;

use App\Http\Resources\File\FileResource;
use App\Http\Resources\User\UserResource;
use App\Models\SaleSystem\Partner;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class PartnerResource
 * @package App\Http\Resources\\App\Models\SaleSystem\Partner
 */
class PartnerResource extends JsonResource
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
            Partner::ID => $this->getId(),
            Partner::LEFT_TREE => $this->getLeftTree(),
            Partner::RIGHT_TREE => $this->getRightTree(),
            Partner::MOBILE => $this->getMobile(),
            Partner::BANK_NAME => $this->getBankName(),
            Partner::IBAN => $this->getIban(),
            Partner::DEFAULT_WARRANTY_DAYS => $this->getDefaultWarrantyDays(),
            Partner::SWIFT => $this->getSwift(),
            Partner::RECEIVE_VAT_RESPONSIBLE => $this->getReceiveVatResponsible(),
            Partner::SEND_VAT_RESPONSIBLE => $this->getSendVatResponsible(),
            Partner::ACTIVE_AUTO_BONUS => $this->getActiveAutoBonus(),
            Partner::ACTIVE_TRAINING_BONUS => $this->getActiveTrainingBonus(),
            Partner::POST_DELIVERY_FACTOR => $this->getPostDeliveryFactor(),
            Partner::RECEIVE_COMMISSION => $this->getReceiveCommission(),
            Partner::CAN_BUY => $this->getCanBuy(),
            Partner::TRANSPORTATION_RATIO_PERCENTAGE => $this->getTransportationRatioPercentage(),
            Partner::OVER_PERSONAL_TURNOVER => $this->getOverPersonalTurnover(),
            Partner::CAN_SEE_DOWN_LINE => $this->getCanSeeDownLine(),
            Partner::INHOUSE_SALE => $this->getInhouseSale(),
            Partner::HAS_NETWORK => $this->getHasNetwork(),
            Partner::HAS_BTOB => $this->getHasBtob(),
            Partner::HAS_BTOC => $this->getHasBtoc(),
            Partner::HAS_WAREHOUSE => $this->getHasWarehouse(),
            Partner::HAS_DELIVERY => $this->getHasDelivery(),
            Partner::WARRANTY_DAYS => $this->getWarrantyDays(),
            Partner::MAX_CLIENT_ROOT => $this->getMaxClientRoot(),
            Partner::CREATED_AT => $this->getCreatedAt(),
            Partner::UPDATED_AT => $this->getUpdatedAt(),
            Partner::IS_ACTIVE => $this->getIsActive(),
            Partner::COUNTRY_ID => $this->getCountryId(),
            'parent' => $this->whenLoaded(
                'parent',
                function () {
                    return new PartnerResource($this->parent);
                }
            ),
            'user' => $this->whenLoaded(
                'user',
                function () {
                    return new UserResource($this->user);
                }
            ),
            'coach' => $this->whenLoaded(
                'coach',
                function () {
                    return new UserResource($this->coach);
                }
            ),
            'backIdentityCard' => $this->whenLoaded(
                'backIdentityCard',
                function () {
                    return new FileResource($this->backIdentityCard);
                }
            ),
            'frontIdentityCard' => $this->whenLoaded(
                'frontIdentityCard',
                function () {
                    return new FileResource($this->frontIdentityCard);
                }
            ),
            'businessCertification' => $this->whenLoaded(
                'businessCertification',
                function () {
                    return new FileResource($this->businessCertification);
                }
            ),
            'network' => $this->whenLoaded(
                'network',
                function () {
                    return new FileResource($this->network);
                }
            ),
        ];
    }
}
