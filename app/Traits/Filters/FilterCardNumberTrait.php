<?php

namespace App\Traits\Filters;

use Illuminate\Database\Eloquent\Builder;

trait FilterCardNumberTrait
{
    /**
     * @param integer $cardNumber Card Number.
     *
     * @return Builder
     */
    public function cardNumber(int $cardNumber): Builder
    {
        return $this->builder->whereCardNumberIs($cardNumber);
    }
}
