<?php

namespace App\Http\Resources\Price;

use App\Models\Price\PriceType;
use App\Models\Translations\PriceTypeTranslation;
use Illuminate\Http\Resources\Json\JsonResource;

class PriceTypeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            PriceType::ID => $this->getId(),
            PriceTypeTranslation::NAME => $this->getName()
        ];
    }
}
