<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasWarehouseTrait
{
    /**
     * @param Builder $builder Builder.
     *
     * @return Builder
     */
    public function scopeWhereHasWarehouse(Builder $builder): Builder
    {
        return $builder->where(self::HAS_WAREHOUSE, true);
    }

    /**
     * @param Builder $builder Builder.
     *
     * @return Builder
     */
    public function scopeWhereHasNotWarehouse(Builder $builder): Builder
    {
        return $builder->where(self::HAS_WAREHOUSE, false);
    }
}
