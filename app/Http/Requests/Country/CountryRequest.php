<?php

namespace App\Http\Requests\Country;

use App\Http\Requests\BaseRequest;
use App\Models\Country\Country;
use App\Models\Currency\Currency;
use App\Models\LocalizableModel;
use App\Models\Translations\CountryTranslation;
use Illuminate\Validation\Rule;

class CountryRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {


        return [
            Country::CURRENCY_ID => ['required', Rule::exists(Currency::TABLE, Currency::ID)],
            Country::DEFAULT_VAT => ['required', 'numeric'],
            Country::DEFAULT_WARRANTY_DAYS => ['required', 'numeric'],
            Country::IS_EEU => ['required', 'bool'],
            Country::MAX_TAX_FREE_TRADE => ['nullable', 'numeric'],
            Country::MAX_SMALL_BUSINESS_TRADE => ['nullable', 'numeric'],
            Country::ISO2 =>
                ['required',
                    'string',
                    'min:2',
                    'max:2',
                    Rule::unique(
                        Country::TABLE,
                        Country::ISO2
                    )->ignore(optional($this->country)->getId())],
            Country::ISO3 =>
                ['required',
                    'string',
                    'min:3',
                    'max:3',
                    Rule::unique(
                        Country::TABLE,
                        Country::ISO3
                    )->ignore(optional($this->country)->getId())],

            LocalizableModel::LOCALIZATION_KEY => ['required', 'array'],
            LocalizableModel::LOCALIZATION_KEY . '.*.locale' => [
                'required',
                'distinct',
                'exists:languages,alpha2'
            ],

            LocalizableModel::LOCALIZATION_KEY . '.*.' . CountryTranslation::NAME => [
                'required',
                'string',
                Rule::unique(
                    CountryTranslation::TABLE,
                    CountryTranslation::NAME
                )->ignore(
                    optional($this->country)->getId()
                ),
            ],
        ];
    }
}
