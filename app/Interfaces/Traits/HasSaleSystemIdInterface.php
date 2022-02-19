<?php

namespace App\Interfaces\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

interface HasSaleSystemIdInterface
{
    /**
     * @param Builder $builder      Builder.
     * @param integer $saleSystemId ID.
     *
     * @return Builder
     */
    public function scopeOrWhereSaleSystemIdIs(Builder $builder, int $saleSystemId): Builder;

    /**
     * @param Builder $builder       Builder.
     * @param array   $saleSystemIds IDs.
     *
     * @return Builder
     */
    public function scopeWhereSaleSystemIdIn(Builder $builder, array $saleSystemIds): Builder;

    /**
     * @return BelongsTo
     */
    public function saleSystem(): BelongsTo;
}
