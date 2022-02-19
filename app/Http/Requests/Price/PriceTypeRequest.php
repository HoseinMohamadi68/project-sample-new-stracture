<?php

namespace App\Http\Requests\Price;

use App\Http\Requests\BaseRequest;
use App\Models\LocalizableModel;
use App\Models\Translations\PriceTypeTranslation;
use Illuminate\Validation\Rule;

class PriceTypeRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            LocalizableModel::LOCALIZATION_KEY => 'required|array',
            LocalizableModel::LOCALIZATION_KEY . '.*.locale' => [
                'required',
                'distinct',
                'exists:languages,alpha2'
            ],
            LocalizableModel::LOCALIZATION_KEY . '.*.' . PriceTypeTranslation::NAME => [
                'required',
                'string',
                Rule::unique(
                    PriceTypeTranslation::TABLE,
                    PriceTypeTranslation::NAME
                )->where(
                    function ($query) {
                        $query->when(!empty($this->priceType), function ($checkUniqueQuery) {
                            $checkUniqueQuery->where(
                                PriceTypeTranslation::PRICE_TYPE_ID,
                                '<>',
                                $this->priceType->getId()
                            );
                        });
                    }
                ),
            ],
        ];
    }
}
