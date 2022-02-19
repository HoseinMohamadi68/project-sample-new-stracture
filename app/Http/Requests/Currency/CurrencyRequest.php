<?php

namespace App\Http\Requests\Currency;

use App\Http\Requests\BaseRequest;
use App\Models\Currency\Currency;

class CurrencyRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            Currency::TITLE => sprintf(
                'string|required|unique:%s,%s,%s',
                Currency::TABLE,
                Currency::TITLE,
                optional($this->currency)->getId()
            ),
            Currency::SYMBOL => sprintf(
                'string|required|unique:%s,%s,%s',
                Currency::TABLE,
                Currency::SYMBOL,
                optional($this->currency)->getId()
            ),
            Currency::ISO3 => sprintf(
                'string|required|min:3|max:3|unique:%s,%s,%s',
                Currency::TABLE,
                Currency::ISO3,
                optional($this->currency)->getId()
            ),
            Currency::RATIO => ['required', 'numeric', 'between:0,100'],
            Currency::IS_DEFAULT => ['boolean', 'required']
        ];
    }
}
