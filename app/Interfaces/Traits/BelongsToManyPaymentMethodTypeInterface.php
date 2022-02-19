<?php

namespace App\Interfaces\Traits;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

interface BelongsToManyPaymentMethodTypeInterface
{
    /**
     * @return BelongsToMany
     */
    public function paymentMethodTypes(): BelongsToMany;
}
