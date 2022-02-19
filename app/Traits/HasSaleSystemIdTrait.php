<?php

namespace App\Traits;

use App\Models\SaleSystem\SaleSystem;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasSaleSystemIdTrait
{
    /**
     * @param Builder $builder      Builder.
     * @param integer $saleSystemId ID.
     *
     * @return Builder
     */
    public function scopeOrWhereSaleSystemIdIs(Builder $builder, int $saleSystemId): Builder
    {
        return $builder->orWhere(self::SALE_SYSTEM_ID, $saleSystemId);
    }

    /**
     * @param Builder $builder       Builder.
     * @param array   $saleSystemIds IDs.
     *
     * @return Builder
     */
    public function scopeWhereSaleSystemIdIn(Builder $builder, array $saleSystemIds): Builder
    {
        return $builder->whereIn(self::SALE_SYSTEM_ID, $saleSystemIds);
    }

    /**
     * @return BelongsTo
     */
    public function saleSystem(): BelongsTo
    {
        return $this->belongsTo(SaleSystem::class);
    }
}
