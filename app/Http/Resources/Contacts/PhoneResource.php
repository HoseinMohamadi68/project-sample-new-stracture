<?php

namespace App\Http\Resources\Contacts;

use App\Models\Contacts\Phone;
use Illuminate\Http\Resources\Json\JsonResource;

class PhoneResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            Phone::ID => $this->getId(),
            Phone::TYPE => $this->getType(),
            Phone::NUMBER => $this->getNumber(),
        ];
    }
}
