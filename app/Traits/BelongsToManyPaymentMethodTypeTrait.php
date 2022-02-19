<?php

namespace App\Traits;

use App\Models\Payment\PaymentMethodType;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait BelongsToManyPaymentMethodTypeTrait
{
    /**
     * @return BelongsToMany
     */
    public function paymentMethodTypes(): BelongsToMany
    {
        return $this->belongsToMany(PaymentMethodType::class);
    }
}
