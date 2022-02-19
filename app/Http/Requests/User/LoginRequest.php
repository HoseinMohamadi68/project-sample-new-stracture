<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BaseRequest;
use App\Models\User\Token;
use App\Models\User\User;

/**
 * Class LoginRequest
 *
 *
 * @package App\Http\Requests
 */
class LoginRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            User::PASSWORD => 'required',
            User::EMAIL => 'required|email',
            Token::FIREBASE_TOKEN => 'nullable|string',
        ];
    }
}
