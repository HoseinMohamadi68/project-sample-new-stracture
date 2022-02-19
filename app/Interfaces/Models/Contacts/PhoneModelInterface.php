<?php

namespace App\Interfaces\Models\Contacts;

use App\Interfaces\Models\BaseModelInterface;
use App\Interfaces\Traits\HasPhoneNumberInterface;
use App\Interfaces\Traits\HasTypeInterface;

interface PhoneModelInterface extends
    BaseModelInterface,
    HasTypeInterface,
    HasPhoneNumberInterface
{
    const TABLE = 'phones';

    /**
     * @param string $type   Type.
     * @param string $number Number.
     *
     * @return PhoneModelInterface
     */
    public static function createObject(string $type, string $number): PhoneModelInterface;

    /**
     * @param string $type   Type.
     * @param string $number Number.
     *
     * @return PhoneModelInterface
     */
    public function updateObject(string $type, string $number): PhoneModelInterface;
}
