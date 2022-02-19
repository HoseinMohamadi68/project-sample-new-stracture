<?php

namespace App\Http\Resources\Language;

use App\Models\Language\Language;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LanguageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request Request.
     *
     * @return array
     */
    public function toArray($request): array
    {
        return [
            Language::ID => $this->getId(),
            Language::TITLE => $this->getTitle(),
            Language::ALPHA2 => $this->getAlpha2(),
            Language::IS_LTR => $this->getIsLtr(),
        ];
    }
}
