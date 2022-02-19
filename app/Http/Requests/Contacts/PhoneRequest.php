<?php

namespace App\Http\Requests\Contacts;

use App\Http\Requests\BaseRequest;
use App\Models\Contacts\Phone;
use Illuminate\Validation\Rule;

class PhoneRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            Phone::TYPE => ['required', Rule::in([Phone::MOBILE,Phone::PHONE,Phone::FAX])],
            Phone::NUMBER => sprintf(
                'required|unique:%s,%s,%s',
                Phone::TABLE,
                Phone::NUMBER,
                optional($this->Number)->getId()
            ),
        ];
    }
}
