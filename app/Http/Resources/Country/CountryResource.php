<?php

namespace App\Http\Resources\Country;

use App\Constants\PermissionTitle;
use App\Http\Resources\Currency\CurrencyResource;
use App\Http\Resources\Language\LanguageResource;
use App\Models\Country\Country;
use App\Models\LocalizableModel;
use App\Models\Translations\CountryTranslation;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class CountryResource extends JsonResource
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
            Country::ID => $this->getId(),
            CountryTranslation::NAME => $this->getName(),
            Country::DEFAULT_VAT => $this->getDefaultVat(),
            Country::DEFAULT_WARRANTY_DAYS => $this->getDefaultWarrantyDays(),
            Country::MAX_TAX_FREE_TRADE => $this->getMaxTaxFreeTrade(),
            Country::MAX_SMALL_BUSINESS_TRADE => $this->getMaxSmallBusinessTrade(),
            Country::IS_EEU => $this->getIsEeu(),
            Country::ISO2 => $this->getIso_2(),
            Country::ISO3 => $this->getIso_3(),

            'currency' => $this->whenLoaded(
                'currency',
                function () {
                    return new CurrencyResource($this->currency);
                }
            ),
            'languages' => $this->whenLoaded(
                'languages',
                function () {
                    return LanguageResource::collection($this->languages);
                }
            ),
            LocalizableModel::LOCALIZATION_KEY => $this->when(
                Auth::check() && $request->user()->hasPermission(PermissionTitle::GET_ALL_COUNTRY_LANGUAGES),
                $this->translations
            )

        ];
    }
}
