<?php

namespace App\Http\Resources\Payment;

use App\Models\Payment\PaymentMethodType;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentMethodTypeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            PaymentMethodType::ID => $this->getId(),
            PaymentMethodType::TITLE => $this->getTitle(),
        ];
    }
}
