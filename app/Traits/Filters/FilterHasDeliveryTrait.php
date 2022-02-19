<?php

namespace App\Traits\Filters;

use Illuminate\Database\Eloquent\Builder;

trait FilterHasDeliveryTrait
{
    /**
     * @param boolean $hasDelivery Has Delivery.
     * @return Builder
     */
    public function hasDelivery($hasDelivery): Builder // phpcs:ignore
    {
        if (is_string($hasDelivery)) {
            $hasDelivery = $hasDelivery === 'true';
        }
        if ($hasDelivery) {
            return $this->builder->whereHasDelivery();
        }

        return $this->builder->whereHasNotDelivery();
    }
}
