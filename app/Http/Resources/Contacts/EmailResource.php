<?php

namespace App\Http\Resources\Contacts;

use App\Models\Contacts\Email;
use Illuminate\Http\Resources\Json\JsonResource;

class EmailResource extends JsonResource
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
            Email::ID => $this->getId(),
            Email::EMAIL => $this->getEmail(),
        ];

    }
}
