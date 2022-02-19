<?php

namespace App\Models\User;

use App\Interfaces\Models\TokenInterface;
use App\Interfaces\Models\User\UserInterface;
use App\Models\BaseModel;
use App\Traits\HasTokenTrait;
use App\Traits\HasUserIdTrait;

class Token extends BaseModel implements TokenInterface
{
    use HasUserIdTrait;
    use HasTokenTrait;

    const TABLE = 'tokens';
    const USER_ID = 'user_id';
    const TOKEN_STRING = 'token_string';
    const FIREBASE_TOKEN = 'firebase_token';
    const AGENT = 'agent';

    /**
     * @param UserInterface $user          User.
     * @param string        $token         Token.
     * @param string|null   $firebaseToken Firebase Token.
     * @param string|null   $agent         Agent.
     *
     * @return TokenInterface
     */
    public static function createObject(
        UserInterface $user,
        string $token,
        ?string $firebaseToken = null,
        ?string $agent = null
    ): TokenInterface {
        $tokenModel = new Token();
        $tokenModel->setUserId($user->getId());
        $tokenModel->setTokenString($token);
        $tokenModel->setFirebaseToken($firebaseToken);
        $tokenModel->setAgent($agent);
        $tokenModel->save();

        return $tokenModel;
    }
}
