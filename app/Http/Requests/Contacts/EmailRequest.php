<?php

namespace App\Http\Requests\Contacts;

use App\Http\Requests\BaseRequest;
use App\Models\Contacts\Email;

class EmailRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            Email::EMAIL => sprintf(
                'required|string|email|unique:%s,%s,%s',
                Email::TABLE,
                Email::EMAIL,
                optional($this->Email)->getId()
            ),
        ];
    }
}
