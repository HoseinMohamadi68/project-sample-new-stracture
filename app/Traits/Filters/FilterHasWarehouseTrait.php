<?php

namespace App\Traits\Filters;

use Illuminate\Database\Eloquent\Builder;

trait FilterHasWarehouseTrait
{
    /**
     * @param boolean $hasWarehouse Has Warehouse.
     * @return Builder
     */
    public function hasWarehouse($hasWarehouse): Builder // phpcs:ignore
    {
        if (is_string($hasWarehouse)) {
            $hasWarehouse = $hasWarehouse === 'true';
        }
        if ($hasWarehouse) {
            return $this->builder->whereHasWarehouse();
        }

        return $this->builder->whereHasNotWarehouse();
    }
}
