<?php

namespace App\Interfaces\Models\Contacts;

use App\Interfaces\Models\BaseModelInterface;
use App\Interfaces\Traits\HasEmailInterface;

interface EmailInterface extends
    BaseModelInterface,
    HasEmailInterface
{
    const TABLE = 'emails';

    /**
     * Create new Object.
     *
     * @param string $email Email.
     *
     * @return EmailInterface
     */
    public static function createObject(string $email): EmailInterface;

    /**
     * Update an Object.
     *
     * @param string $email Email.
     *
     * @return EmailInterface
     */
    public function updateObject(string $email): EmailInterface;
}
