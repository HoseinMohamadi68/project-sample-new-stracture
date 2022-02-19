<?php

namespace App\Interfaces\Models;

use App\Interfaces\Models\User\UserInterface;
use App\Interfaces\Traits\HasTokenInterface;
use App\Interfaces\Traits\HasUserIdInterface;

interface TokenInterface extends
    BaseModelInterface,
    HasTokenInterface,
    HasUserIdInterface
{

    /**
     * @param UserInterface $user          User.
     * @param string        $token         Token.
     * @param string|null   $firebaseToken Firebase Token.
     * @param string|null   $agent         Agent.
     *
     * @return self
     */
    public static function createObject(
        UserInterface $user,
        string $token,
        ?string $firebaseToken = null,
        ?string $agent = null
    ): TokenInterface;
}
