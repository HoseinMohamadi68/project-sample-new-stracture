<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BaseRequest;
use App\Models\User\User;

/**
 * Class UserRequest
 *
 * @package App\Http\Requests
 */
class UserRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            User::APPROVED => 'nullable|boolean',
            User::EMAIL => 'nullable|email',
            User::MOBILE => sprintf(
                'required|unique:%s,%s,%s|regex:/(09)[0-9]{9}/',
                User::TABLE,
                User::MOBILE,
                optional($this->user)->{User::ID}
            ),
            User::FIRST_NAME => 'nullable|string|max:150',
            User::LAST_NAME => 'nullable|string',
            User::CHARGE => 'nullable|numeric',
            User::PASSWORD => 'nullable',
            User::PHONE => 'nullable|max:13',
        ];
    }
}
