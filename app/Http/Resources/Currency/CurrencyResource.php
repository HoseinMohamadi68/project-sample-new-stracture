<?php

namespace App\Http\Resources\Currency;

use App\Models\Currency\Currency;
use Illuminate\Http\Resources\Json\JsonResource;

class CurrencyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request): array
    {
        return [
            Currency::TITLE => $this->getTitle(),
            Currency::RATIO => $this->getRatio(),
            Currency::IS_DEFAULT => (bool)$this->getIsDefault(),
            Currency::SYMBOL => $this->getSymbol(),
            Currency::ISO3 => $this->getIso3(),
        ];
    }

}
