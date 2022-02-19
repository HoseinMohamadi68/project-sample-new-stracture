<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BaseRequest;
use App\Models\User\User;

/**
 * Class UserProfileRequest
 *
 * @package App\Http\Requests
 */
class UserProfileRequest extends BaseRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            User::FIRST_NAME => 'required|string|max:150',
            User::LAST_NAME => 'required|string',
            User::EMAIL => sprintf(
                'nullable|unique:%s,%s,%s',
                User::TABLE,
                User::EMAIL,
                optional($this->user)->{User::ID}
            ),
            User::PASSWORD => 'nullable',
            User::PHONE => 'nullable|max:13',
        ];
    }
}
