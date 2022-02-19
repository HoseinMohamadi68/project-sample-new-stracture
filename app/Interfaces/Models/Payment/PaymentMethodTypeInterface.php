<?php

namespace App\Interfaces\Models\Payment;

use App\Interfaces\Models\BaseModelInterface;
use App\Interfaces\Traits\BelongsToManySaleSystemInterface;
use App\Interfaces\Traits\HasTitleInterface;

interface PaymentMethodTypeInterface extends
    BaseModelInterface,
    HasTitleInterface,
    BelongsToManySaleSystemInterface
{
    const TABLE = 'payment_method_types';
}
